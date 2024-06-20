<?php

namespace App\Http\Controllers;

use App\Models\Alterkrit;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Subkriteria;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use PDO;
use Yajra\DataTables\DataTables;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->role == 'guru'){
            return abort(403, 'Maaf, Halaman Ini Bukan Untuk Anda');
        }

        $kriteriadata = Kriteria::all();
        $alternatifdata = Alternatif::all();
        $alterkrit = Alterkrit::all();

        if ($request->ajax()){
            return Datatables::of($kriteriadata)
            ->addColumn('action', function($data) {
                if ($data->tipe == 'range') {
                    // Ambil subkriteria pertama sebagai contoh
                    $subkritfirst = $data->subkriterias->first();
                    $subkritlast = $data->subkriterias->last();
                    if ($subkritfirst) {
                        $min = $subkritfirst->range_awal;

                    } else {
                        $min = 0;
                         // Default range jika subkriteria tidak ditemukan
                    }
                    if ($subkritlast) {
                        $max = $subkritlast->range_akhir;
                    }else {
                        $max = 1000;
                    }

                    // Cek nilai sebelumnya dari tabel penilaian
                    $nilaiSebelumnya = null;
                    try {
                        $nilaiSebelumnya = Penilaian::where('id_user', auth()->user()->id)
                                        ->where('id_kriteria', $data->id)
                                        ->first()->inputan;
                    } catch (\Throwable $th) {
                        $nilaiSebelumnya = null;
                    }

                    return '<div class="mb-1">
                        <input type="number" name="inputan['.$data->id.']['.auth()->user()->id.']" value="'.($nilaiSebelumnya ?? '').'" class="form-control range-input" data-kriteria-id="'.$data->id.'" min="'.$min.'" max="'.$max.'" inputmode="numeric" />
                    </div>';

                } else {
                    $subkrits = $data->subkriterias;
                    try {
                        $nilaidata = Penilaian::where('id_user', auth()->user()->id)
                                    ->where('id_kriteria', $data->id)
                                    ->first()->id_subkriteria;
                    } catch (\Throwable $th) {
                        $nilaidata = null;
                    }

                    $dropdown = '<select name="inputan['.$data->id.']['.auth()->user()->id.']" class="form-select" id="basicSelect">
                    <option value=""';
                    if ($nilaidata == null) {
                        $dropdown .= 'selected="selected"';
                    }
                    $dropdown .= '>Pilih</option>';
                    foreach ($subkrits as $sbd) {
                        $dropdown .= '<option value="'.$sbd->id.'"';
                        if ($sbd->id == $nilaidata) {
                            $dropdown .= 'selected="selected"';
                        }
                        $dropdown .= '>'.$sbd->bobot.' | '.$sbd->nama.'</option>';
                    }
                    $dropdown .= '</select>';
                    return $dropdown;
                }
            })
            ->addColumn('klasifikasi', function($data) {
                if ($data->tipe != 'range') {
                    return '';
                }

                $subkrits = $data->subkriterias;
                $nilaidata = null;

                try {
                    $nilaidata = Penilaian::where('id_user', auth()->user()->id)
                                          ->where('id_kriteria', $data->id)
                                          ->first()->id_subkriteria;
                } catch (\Throwable $th) {
                    $nilaidata = null;
                }

                $dropdown = '<select name="'.$data->id.'" class="form-select klasifikasi-select" id="klasifikasiSelect_'.$data->id.'" data-kriteria-id="'.$data->id.'" disabled>
                <option value=""';
                if ($nilaidata == null) {
                    $dropdown .= ' selected="selected"';
                }
                $dropdown .= '>Pilih</option>';
                foreach ($subkrits as $sbd) {
                    $dropdown .= '<option value="'.$sbd->id.'" data-range-awal="'.$sbd->range_awal.'" data-range-akhir="'.$sbd->range_akhir.'"';
                    if ($nilaidata == $sbd->id) {
                        $dropdown .= ' selected="selected"';
                    }
                    $dropdown .= '>';
                    $dropdown .= $sbd->bobot.' | '.$sbd->nama.'</option>';
                }
                $dropdown .= '</select>';
                return $dropdown;
            })
            ->addColumn('kode', function($data){
                $kodekriteria = 'C'.$data->id;
                return $kodekriteria;
            })
        ->rawColumns(['action', 'klasifikasi'])
            ->addIndexColumn()
            ->make(true);
        }

        try {
            $latestkriteria_id = Kriteria::latest()->first()->id+1;
        } catch (\Throwable $th) {
            $latestkriteria_id = 0;
        }

        return view('auth.penilaian', ['kriteriadata' => $kriteriadata, 'latestkriteria_id' => $latestkriteria_id, 'alternatifdata' => $alternatifdata, 'alterkritdata' => $alterkrit]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'inputan' => 'required|array',
            'inputan.*.*' => 'required'
        ]);

        $id_user = auth()->user()->id;

        // Check if inputan exists and is an array
        if (!isset($request->inputan) || !is_array($request->inputan)) {
            return back()->with('error', 'Invalid input data.');
        }

        foreach ($request->inputan as $id_kriteria => $inputan) {
            // Check if each inputan item is an array
            if (!is_array($inputan)) {
                continue;
            }

            foreach ($inputan as $id_alternatif => $value) {
                // Find the kriteria by ID
                $kriteria = Kriteria::find($id_kriteria);

                if (!$kriteria) {
                    continue;
                }

                if ($kriteria->tipe == 'range') {
                    $nilai = floatval($value);
                    $subkriteria = Subkriteria::where('id_kriteria', $id_kriteria)
                        ->where('range_awal', '<=', $nilai)
                        ->where('range_akhir', '>=', $nilai)
                        ->first();

                    if ($subkriteria) {
                        Penilaian::updateOrCreate(
                            [
                                'id_user' => $id_user,
                                'id_kriteria' => $id_kriteria
                            ],
                            [
                                'id_subkriteria' => $subkriteria->id,
                                'inputan' => $nilai,
                                'nilai' => $subkriteria->bobot
                            ]
                        );
                    }
                } else {
                    $subkriteria = Subkriteria::find($value);

                    if ($subkriteria) {
                        Penilaian::updateOrCreate(
                            [
                                'id_user' => $id_user,
                                'id_kriteria' => $id_kriteria
                            ],
                            [
                                'id_subkriteria' => $subkriteria->id,
                                'inputan' => null,
                                'nilai' => $subkriteria->bobot
                            ]
                        );
                    }
                }
            }
        }

        return back()->with('success', 'Penilaian berhasil disimpan.');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(Penilaian $penilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penilaian $penilaian)
    {
        //
    }

    public function editpenilaian(Request $req)
    {
        $user = auth()->user();

        $kritlast = Kriteria::latest()->first()->id;

        // $penilaianlast = Penilaian::latest()->first()->id;
        $err_count = 0;
        for ($id=1; $id <= $kritlast ; $id++) {
            try {
                $validation = Kriteria::where('id', $id)->first()->id;
            } catch (\Throwable $th) {
                $validation = null;
                continue;
            }
            $sub = Subkriteria::where('id', $req->$id)->first();
            try {
                try {
                    $nilaiid = Penilaian::where('id_user', $user->id)
                                    ->where('id_alternatif', $req->alternatifid)
                                    ->where('id_kriteria', $validation)->first();

                    if ($req->$id == "") {
                        try {
                            $nilaiid = Penilaian::where('id_user', $user->id)
                                    ->where('id_alternatif', $req->alternatifid)
                                    ->where('id_kriteria', $validation)->delete();
                        } catch (\Throwable $th) {
                            $err_count = $err_count + 1;
                        }
                    }
                    Penilaian::where('id', $nilaiid->id)->update(
                        [
                            'id_user' => $user->id,
                            'id_alternatif' => $req->alternatifid,
                            'id_kriteria' => $sub->id_kriteria,
                            'id_subkriteria' => $sub->id,
                            'nilai' => $sub->bobot
                        ]);

                } catch (\Throwable $th) {
                    // $nilaiid = null;
                    Penilaian::create(
                        [
                            'id_user' => $user->id,
                            'id_alternatif' => $req->alternatifid,
                            'id_kriteria' => $sub->id_kriteria,
                            'id_subkriteria' => $sub->id,
                            'nilai' => $sub->bobot
                        ]);
                }
            } catch (\Throwable $th) {
                $err_count = $err_count + 1;
            }
        }

        if ($err_count == 0) {
            return back()->with('success', 'Nilai Sudah Disimpan* ('.$err_count.')');
        } else {
            return back()->with('error', 'Nilai Sudah Disimpan, Tapi Belum Lengkap. ('.$err_count.')');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penilaian $penilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penilaian $penilaian)
    {
        //
    }
}
