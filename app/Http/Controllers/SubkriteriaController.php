<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 'guru'){
            return abort(403, 'Maaf, Halaman Ini Bukan Untuk Anda');
        }

        $subsdata = Subkriteria::all();
        $kriteriadata = Kriteria::all();
        return view('auth.subkriteria', ['kriteriadata' => $kriteriadata, 'subsdata' => $subsdata]);
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
            'nama' => [
                'unique:App\Models\Subkriteria,nama'
            ]
        ]);

        $kriteria = Kriteria::find($req->id_kriteria);

        try {
            if ($kriteria->tipe == 'range') {
                Subkriteria::create([
                    'id_kriteria' => $req->id_kriteria,
                    'nama' => $req->nama,
                    'range_awal' => $req->range_awal,
                    'range_akhir' => $req->range_akhir,
                    'bobot' => $req->bobot
                ]);
            }else {
                Subkriteria::create([
                    'id_kriteria' => $req->id_kriteria,
                    'nama' => $req->nama,
                    'bobot' => $req->bobot
                ]);
            }
            return back()->with('success', 'Sub-kriteria Berhasil Dibuat.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Maaf, Terdapat Kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Subkriteria $subkriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function editsubkriteria(Request $req)
    {
        // dd($req);
        $kriteria = Kriteria::find(Subkriteria::where('id', $req->idsub)->first()->id_kriteria);
        // dd($kriteria);
        try {
            if ($kriteria->tipe == 'range') {
                Subkriteria::where('id', $req->idsub)->update([
                    'nama' => $req->nama,
                    'range_awal' => $req->range_awal,
                    'range_akhir' => $req->range_akhir,
                    'bobot' => $req->bobot
                ]);
            }else {
                Subkriteria::where('id', $req->idsub)->update([
                    'nama' => $req->nama,
                    'bobot' => $req->bobot
                ]);
            }
            Subkriteria::where('id', $req->idsub)->update([
                'nama' => $req->nama,
                'bobot' => $req->bobot
            ]);
            return back()->with('success', 'Kriteria Berhasil Diedit.');
        } catch (\Throwable $e) {
            dd($e);
            return back()->with('error', 'Terdapat Kesalahan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subkriteria $subkriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penilaian::where('id_subkriteria', $id)->delete();
        Subkriteria::where('id', $id)->delete();
        return back()->with('success', 'Kriteria Berhasil Dihapus.');
    }
}
