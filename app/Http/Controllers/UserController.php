<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function indexLogin()
    {
        #tampilkan halaman login
        return view('login');
    }

    public function login(Request $request)
    {
        #logic untuk autentikasi
        $user = User::where('username', $request->username)->first();

        $attr = request()->validate([
            'username' => ['required'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::attempt($attr)){
            Auth::login($user);
        return redirect()->intended('/dash')->with('sukses', "Login Sukses");
        } else {
            return back()->with('gagal', 'Username / Password Salah!');
        }
    }

    public function logout()
    {
        #fungsi untuk logout
        Auth::logout();
        return redirect()->intended('/login')->with('sukses', 'logout berhasil');
    }

    public function indexDash()
    {
        #fungsi menampilkan tampilan dashboard
        $jmlalter = Alternatif::all()->count();
        $jmlpenilai = User::where('role', 'user')->count();
        $jmlkrit = Kriteria::all()->count();
        $jmlsubkrit = Subkriteria::all()->count();
        $kriteria = Kriteria::all();

        return view('auth.dashboard', [
            'jmlalter' => $jmlalter,
            'jmlpenilai' => $jmlpenilai,
            'jmlkrit' => $jmlkrit,
            'jmlsubkrit' => $jmlsubkrit,
            'kriteria' => $kriteria,
        ]);
    }

    public function welcome(){
        #fungsi menampilkan tampilan dashboard
    $jmlalter = Alternatif::all()->count();
    $jmlpenilai = User::where('role', 'user')->count();
    $jmlkrit = Kriteria::all()->count();
    $jmlsubkrit = Subkriteria::all()->count();
    $kriteria = Kriteria::all();

    return view('welcome', [
        'jmlalter' => $jmlalter,
        'jmlpenilai' => $jmlpenilai,
        'jmlkrit' => $jmlkrit,
        'jmlsubkrit' => $jmlsubkrit,
        'kriteria' => $kriteria,
    ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        #untuk tampilkan halaman user management beserta datatabel-nya.
        if (auth()->user()->role != 'admin'){
            return abort(403, 'Maaf, Halaman Ini Bukan Untuk Anda');
        }

        $userdata = User::all();
        $usercount = User::count();

        if ($request->ajax()){
            return DataTables::of($userdata)
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
        return view('auth.usermgmt', ['userdata' => $userdata, 'latestuser_id' => $usercount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // dd($r);
        #controller ini diperuntukan untuk membuat akun.
        $rules = [
            'password' => [
                'min:8'
            ],
            'username' => [
                'unique:App\Models\User,username',
            ],
        ];

        $messages = [
            'min' => 'Maaf, password kamu harus minimal 8 karakter',
            'unique' => 'Maaf, Username Sudah Terdaftar Sebelumnya',
        ];

        $this->validate($r, $rules, $messages);

        try {
            User::create([
                'id' => $r->id,
                'name' => $r->name,
                'role' => $r->role,
                'username' => $r->username,
                'password' => bcrypt($r->password),
                'decrypted_password' => $r->password
            ]);
            return back()->with('success', 'User telah dibuat');
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, Terdapat Kesalahan', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {
        #fungsi untuk mengedit user
        try {
            if ($req->password == '') {
                User::where('id', $req->idedit)->update([
                    'id' => $req->id,
                    'name' => $req->name,
                    'role' => $req->role,
                    'username' => $req->username,
                ]);
            }else{
                User::where('id', $req->idedit)->update([
                    'id' => $req->id,
                    'name' => $req->name,
                    'role' => $req->role,
                    'username' => $req->username,
                    'password' => bcrypt($req->password),
                    'decrypted_password' => $req->password
                ]);
            }
            return back()->with('success', 'User Berhasil Diedit.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terdapat Kesalahan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        #ini untuk menghapus user
        try {
            Penilaian::where('id_user', $id)->delete();
            User::where('id', $id)->delete();
            return back()->with('success', 'User Berhasil Dihapus.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, User Tidak Dapat Dihapus', $th);
        }
    }
}
