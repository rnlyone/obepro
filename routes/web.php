<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\ProfmatController;
use App\Http\Controllers\SubkriteriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['guest']], function(){
    Route::get('login', [UserController::class, 'indexLogin'])->name('login');
    Route::get('register', [UserController::class, 'indexRegister'])->name('register');
    Route::post('login', [UserController::class, 'login'])->name('auth.login');
    Route::post('register', [UserController::class, 'register'])->name('auth.register');
});

Route::group(['middleware'=>['auth']], function(){
    Route::get('dash', [UserController::class, 'indexDash']);

    Route::resource('alternatif', AlternatifController::class)->except('edit', 'destroy');
    Route::get('alternatif/destroy/{id}', [AlternatifController::class, 'destroy']);
    Route::post('alternatif/edit', [AlternatifController::class, 'editalternatif'])->name('alternatif.edit');

    Route::resource('kriteria', KriteriaController::class)->except('edit', 'destroy');
    Route::get('kriteria/destroy/{id}', [KriteriaController::class, 'destroy']);
    Route::post('kriteria/edit', [KriteriaController::class, 'editkriteria'])->name('kriteria.edit');
    Route::post('kriteria/faktor', [KriteriaController::class, 'editfaktor'])->name('kriteria.faktor.edit');

    Route::resource('subkriteria', SubkriteriaController::class)->except('edit', 'destroy');
    Route::get('subkriteria/destroy/{id}', [SubkriteriaController::class, 'destroy']);
    Route::post('subkriteria/edit', [SubkriteriaController::class, 'editsubkriteria'])->name('subkriteria.edit');

    Route::resource('user', UserController::class)->except('destroy', 'edit', 'show', 'update', 'store');
    Route::post('user/store', [UserController::class, 'store']);
    Route::post('user/edit', [UserController::class, 'edit']);
    Route::get('user/destroy/{id}', [UserController::class, 'destroy']);

    Route::resource('penilaian', PenilaianController::class)->except(['destroy', 'edit', 'update']);
    Route::post('penilaian/edit', [PenilaianController::class, 'editpenilaian']);

    Route::get('logout', [UserController::class, 'logout'])->name('auth.logout');

    Route::get('profmat', [ProfmatController::class, 'profmat'])->name('profmat.index');
    Route::get('hasil', [ProfmatController::class, 'indexHasil']);
    Route::get('hasiluser', [ProfmatController::class, 'hasilUser']);
});

Route::get('daftar', [AlternatifController::class, 'pemainForm'])->name('pemain.daftar');
Route::post('daftar', [AlternatifController::class, 'pemainStore'])->name('pemain.store');

Route::get('hasil-guest', [ProfmatController::class, 'indexHasilGuest'])->name('hasil.guest');

Route::get('/', function () {
    return redirect()->intended('/dash');
});

Route::get('/menumakan', function () {
    $alter = Alternatif::all();
    return view('auth.menumakan',['alter' => $alter]);
});
