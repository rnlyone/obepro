<?php

namespace App\Http\Controllers;

use App\Models\Alterkrit;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KriteriaController extends Controller
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
            ->addColumn('action', function($data){
                $button = '
                <button data-toggle="modal" data-bs-toggle="modal" data-original-title="Edit" type="button" data-bs-target="#modaledit'.$data->id.'" type="button" class="edit-post btn btn-icon btn-info">
                    <i data-feather="edit-3"></i>
                </button>';
                // $button .= '&nbsp;&nbsp;';
                $button .= '
                <button data-toggle="modal" data-bs-toggle="modal" name="faktor" data-original-title="faktor" data-bs-target="#modalfaktor'.$data->id.'" type="button" class="faktor btn btn-icon btn-secondary">
                    <i data-feather="settings"></i>
                </button>';
                $button .= '
                <button data-toggle="modal" data-bs-toggle="modal" name="delete" data-original-title="delete" data-bs-target="#modaldel'.$data->id.'" type="button" class="delete btn btn-icon btn-outline-danger">
                    <i data-feather="trash-2"></i>
                </button>';
                return $button;
            })
            ->addColumn('kode', function($data){
                $kodekriteria = 'C'.$data->id;
                return $kodekriteria;
            })
        ->rawColumns(['action', 'kode'])
            ->addIndexColumn()
            ->make(true);
        }

        try {
            $latestkriteria_id = Kriteria::latest()->first()->id+1;
        } catch (\Throwable $th) {
            $latestkriteria_id = 0;
        }

        return view('auth.kriteria', ['kriteriadata' => $kriteriadata, 'latestkriteria_id' => $latestkriteria_id, 'alternatifdata' => $alternatifdata, 'alterkritdata' => $alterkrit]);
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
    public function store(Request $req)
    {
        $req->validate([
            'id' => [
                'unique:App\Models\Kriteria,id',
                'required'
            ],
            'nama' => [
                'regex:/^[a-zA-Z ]+$/u',
                'unique:App\Models\Kriteria,nama',
                'required'
            ],
            'tipe' => [
                'required'
            ],
            'target' => [
                'required',
                'numeric'
            ]
        ]);

        try {
            Kriteria::create([
                'id' => $req->id,
                'nama' => $req->nama,
                'tipe' => $req->tipe,
                'target' => $req->target
            ]);
            return back()->with('success', 'Kriteria Berhasil Dibuat.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Maaf, Terdapat Kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Kriteria $kriteria)
    {
        //
    }

    public function editkriteria(Request $req)
    {
        $req->validate([
            'nama' => [
                'regex:/^[a-zA-ZåäöÅÄÖ\s\-]+$/',
            ],
        ]);

        try {
            // dd($req);
            Kriteria::where('id', $req->id)->update([
                'nama' => $req->nama,
                'tipe' => $req->tipe,
                'target' => $req->target
            ]);
            return back()->with('success', 'Kriteria Berhasil Diedit.');
        }catch (Exception $e) {
            return back()->with('error', 'Maaf, Terdapat Kesalahan');
        }

    }

    public function editfaktor(Request $req){
        // Mengambil semua alternatif dan kriteria yang relevan
        $alternatifdata = Alternatif::all();
        $kriteriadatakey = $req->except('_token'); // Mengambil semua input kecuali token CSRF

        // Loop melalui setiap alternatif dan kriteria untuk menyimpan nilai
        foreach ($alternatifdata as $al) {
            foreach ($kriteriadatakey as $key => $value) {
                // Memecah key untuk mendapatkan id_kriteria dan id_alternatif
                $ids = explode('_', $key);
                // dd($ids);

                if (count($ids) == 2) {
                    $id_kriteria = $ids[0];
                    $id_alternatif = $ids[1];

                    // Cari atau buat record Alterkrit
                    $alterkrit = Alterkrit::firstOrNew([
                        'id_alternatif' => $id_alternatif,
                        'id_kriteria' => $id_kriteria
                    ]);

                    // Update nilai faktor
                    $alterkrit->faktor = $value;
                    $alterkrit->save();
                }
            }
        }

        return back()->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kriteria $kriteria, $id)
    {
        Subkriteria::where('id_kriteria', $id)->delete();
        Kriteria::where('id', $id)->delete();
        return back()->with('success', 'Kriteria Berhasil Dihapus.');
    }
}
