<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\Redis;

class AlternatifController extends Controller
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

        $alterdata = Alternatif::all();

        if ($request->ajax()){
            return Datatables::of($alterdata)
            ->addColumn('action', function($data){
                $button = '
                <button data-toggle="modal" data-bs-toggle="modal" data-original-title="Edit" type="button" data-bs-target="#modaledit'.$data->id.'" type="button" class="edit-post btn btn-icon btn-info">
                    <i data-feather="edit-3"></i>
                </button>';
                // $button .= '&nbsp;&nbsp;';
                $button .= '
                <button data-toggle="modal" data-bs-toggle="modal" name="delete" data-original-title="delete" data-bs-target="#modaldel'.$data->id.'" type="button" class="delete btn btn-icon btn-outline-danger">
                    <i data-feather="trash-2"></i>
                </button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        try {
            $latestalter_id = Alternatif::latest()->first()->id;
        } catch (\Throwable $th) {
            $latestalter_id = 0;
        }




        return view('auth.alternatif', ['alterdata' => $alterdata, 'latestalter_id' => $latestalter_id]);
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
                'unique:App\Models\Alternatif,id',
                'required'
            ],
            'nama' => [
                'unique:App\Models\Alternatif,nama',
                'required'
            ]
        ]);

        try {
            Alternatif::create([
                'id' => $req->id,
                'nama' => $req->nama
            ]);
            return back()->with('success', 'Alternatif Berhasil Dibuat.');
        } catch (Exception $e) {
            return back()->with('error', 'Maaf, Terdapat Kesalahan', $e);
        }
    }

    public function editalternatif(Request $req)
    {
        $validatedData = $req->validate([
            'id' => [
                'unique:App\Models\Alternatif,id,'.$req->idedit,
                'required'
            ],
            'nama' => 'required|string',
            'tempatlahir' => 'required|string',
            'borndate' => 'required|date',
            'alamat' => 'required|string',
            'nohp' => 'required|string',
            'email' => 'required|email',
        ]);

        try {
            Alternatif::findOrFail($req->id)->update($validatedData);
            return back()->with('success', 'Alternatif Berhasil Diedit.');
        } catch (Exception $e) {
            return back()->with('error', 'Maaf Alternatif Gagal Diedit');
        }
    }

    public function pemainStore(Request $request)
    {
        // Validasi input form jika diperlukan
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'tempatlahir' => 'required|string',
            'borndate' => 'required|date',
            'alamat' => 'required|string',
            'nohp' => 'required|string',
            'email' => 'required|email',
            // Tambahkan validasi untuk kolom-kolom baru jika diperlukan
        ]);

        // Simpan data ke dalam database
        Alternatif::create($validatedData);

        return back()->with('success', 'Pemain berhasil disimpan.');

    }

    public function pemainForm(Request $request)
    {
        $alternatif = Alternatif::all();

        return view('daftar', [
            'alternatif' => $alternatif,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function show(Alternatif $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternatif $alternatif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alternatif $alternatif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternatif $alternatif, $id)
    {
        Penilaian::where('id_alternatif', $id)->delete();
        Alternatif::where('id', $id)->delete();
        return back()->with('success', 'Alternatif Berhasil Dihapus.');
    }
}
