<?php

namespace App\Http\Controllers;

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

        if ($request->ajax()){
            return Datatables::of($kriteriadata)
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
            ->addColumn('kode', function($data){
                $kodekriteria = 'C'.$data->id;
                return $kodekriteria;
            })
            ->addColumn('jenis_krit', function($data){
                if($data->jenis_kriteria == 'cf'){
                    $jenis = 'Core Factor';
                }else {
                    $jenis = 'Secondary Factor';
                }
                return $jenis;
            })
        ->rawColumns(['action', 'kode', 'jenis_krit'])
            ->addIndexColumn()
            ->make(true);
        }

        try {
            $latestkriteria_id = Kriteria::latest()->first()->id+1;
        } catch (\Throwable $th) {
            $latestkriteria_id = 0;
        }

        return view('auth.kriteria', ['kriteriadata' => $kriteriadata, 'latestkriteria_id' => $latestkriteria_id]);
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
            'jenis_kriteria' => [
                'required'
            ]
        ]);

        try {
            Kriteria::create([
                'id' => $req->id,
                'nama' => $req->nama,
                'jenis_kriteria' => $req->jenis_kriteria,
            ]);
            return back()->with('success', 'Kriteria Berhasil Dibuat.');
        } catch (\Throwable $th) {
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
                'jenis_kriteria' => $req->jenis_kriteria,
            ]);
            return back()->with('success', 'Kriteria Berhasil Diedit.');
        }catch (Exception $e) {
            return back()->with('error', 'Maaf, Terdapat Kesalahan');
        }

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
