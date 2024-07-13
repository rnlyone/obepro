<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as FacadesValidator;

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
            ->addColumn('gambar', function($data){
                $gambarUrl = asset('storage/files/gambar/' . $data->gambar);
                $image = '<img style="max-width: 100%" src="'.$gambarUrl.'" alt="">';
                return $image;
            })
            ->rawColumns(['action', 'gambar'])
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
        // dd($req->hasFile('gambar'));
        $validator = FacadesValidator::make($req->all(), [
            'id' => 'required|unique:alternatifs,id',
            'nama' => 'required|unique:alternatifs,nama',
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif', // Adjust as per your requirements
            'caption' => 'required',
            'catatan' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Handle file upload
            if ($req->hasFile('gambar')) {
                $gambar = $req->file('gambar');
                $gambar_name = time() . '_' . $gambar->getClientOriginalName();
                $gambar->storeAs('files/gambar', $gambar_name); // Adjust storage path as needed

                // Create alternatif with image
                $alternatif = Alternatif::create([
                    'id' => $req->id,
                    'nama' => $req->nama,
                    'gambar' => $gambar_name, // Save image name to database
                    'caption' => $req->caption,
                    'catatan' => $req->catatan
                ]);
            } else {
                // Create alternatif without image
                Alternatif::create([
                    'id' => $req->id,
                    'nama' => $req->nama,
                    'caption' => $req->caption,
                    'catatan' => $req->catatan
                ]);
            }

            return back()->with('success', 'Alternatif Berhasil Dibuat.');
        } catch (\Exception $e) {
            return back()->with('error', 'Maaf, Terdapat Kesalahan: ' . $e->getMessage());
        }
    }

    public function editalternatif(Request $req)
    {
        // Validate incoming request
        $validator = FacadesValidator::make($req->all(), [
            'id' => [
                'required',
                'string',
                'unique:alternatifs,id,' . $req->idedit,
            ],
            'nama' => 'required|string',
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust as per your requirements
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Find the alternatif by ID
            $alternatif = Alternatif::findOrFail($req->idedit);

            // Update the alternatif data
            $alternatif->id = $req->id;
            $alternatif->nama = $req->nama;
            $alternatif->caption = $req->caption;
            $alternatif->catatan = $req->catatan;

            // Handle image update
            if ($req->hasFile('gambar')) {
                $gambar = $req->file('gambar');
                $gambar_name = time() . '_' . $gambar->getClientOriginalName();
                $gambar->storeAs('files/gambar', $gambar_name); // Adjust storage path as needed

                // Delete old image if necessary
                Storage::delete('files/gambar/' . $alternatif->gambar);

                // Update alternatif with new image
                $alternatif->gambar = $gambar_name;
            }

            // Save the alternatif
            $alternatif->save();

            return back()->with('success', 'Alternatif Berhasil Diedit.');
        } catch (\Exception $e) {
            return back()->with('error', 'Maaf, Terdapat Kesalahan: ' . $e->getMessage());
        }
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
        Alternatif::where('id', $id)->delete();
        return back()->with('success', 'Alternatif Berhasil Dihapus.');
    }
}
