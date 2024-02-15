<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeluarController;
use App\Http\Controllers\MasukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});


// Route::resource('barang', BarangController::class)->middleware('auth');

// Route::get('login', [LoginController::class,'index'])->name('login')->middleware('guest');
// Route::post('login', [LoginController::class,'authenticate']);
// Route::post('logout', [LoginController::class,'logout']);
// Route::get('register', [RegisterController::class, 'create'])->name('register');
// Route::post('register', [RegisterController::class, 'store']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    Route::resource('kategori', KategoriController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('barangmasuk', MasukController::class);
    Route::resource('barangkeluar', KeluarController::class);
    Route::resource('siswa', SiswaController::class);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('logout', [LoginController::class,'logout'])->name('logout');
});