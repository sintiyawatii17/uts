<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ArtikelController;





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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/contact', function() {
	return view("contact");
});

Route::get('/register', function() {
	return view("register");
});

 Route::get('/home', [ClientController:: class, 'index']); 

// Route::get('/home', function() {
	// return view("home");

Route::get('/detail', function() {
	return view("detail");
});


Route::get('/beranda',[HomeController :: class, 'showBeranda']);
Route::get('/barang',[HomeController :: class, 'showBarang']);
Route::get('/kategori',[HomeController :: class, 'showKategori']);

Route::get('test/{produk}/{hargaMin?}/{hargaMax?}', [HomeController::class, 'test']);


Route::prefix('admin')->middleware('auth')->group(function(){
	Route::post('artikel/filter', [ArtikelController:: class, 'filter']);
    Route::resource('artikel', ArtikelController:: class);
	Route::post('produk/filter',[ProdukController :: class, 'filter']);
	Route::resource('/produk', ProdukController :: class);
    Route::resource('/user', UserController :: class);
    Route::resource('/kategori', KategoriController :: class);
});
  
    

Route::get('/login',[AuthController :: class, 'showLogin'])->name('login');
Route::post('/login',[AuthController :: class, 'loginProcess']);
Route::get('/logout',[AuthController :: class, 'logout']);