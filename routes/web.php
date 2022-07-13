<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','Auth\LoginController@index')->name('login')->middleware('guest');
Route::post('/login','Auth\LoginController@authenticate')->name('log_in');
Route::post('/logout','Auth\LoginController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/index','IndexController@index')->name('index');
    //produk
    Route::get('/produk','ProdukController@index')->name('produk');
    Route::get('/produk-table','ProdukController@fetchTable')->name('produk-table');
    Route::post('/produk','ProdukController@store')->name('produk-add');
    Route::get('/produk/{id}','ProdukController@edit');
    Route::post('/produk/{id}','ProdukController@update');
    Route::delete('/produk/{id}','ProdukController@destroy');

    //penjualan
    Route::get('/penjualan','PenjualanController@index')->name('penjualan');
    Route::get('/penjualan-table','PenjualanController@fetchTable')->name('penjualan-table');
    Route::get('/penjualan-detail/{tgl}','PenjualanController@penjualanDetail');
    Route::get('/penjualan-detail/show/{tgl}','PenjualanController@fetchDetail');
    Route::get('/get/nama_produk','PenjualanController@fetchProduk');
    Route::post('/penjualan','PenjualanController@store')->name('penjualan-add');
    Route::get('/penjualan/{id}','PenjualanController@edit');
    Route::post('/penjualan/{id}','PenjualanController@update');
    Route::delete('penjualan/{id}','PenjualanController@destroy');

    //hitungan
    Route::get('/perhitungan','PerhitunganController@index')->name('perhitungan');
    Route::get('/perhitungan-table','PerhitunganController@fetchHitung');
    Route::post('/perhitungan-save','PerhitunganController@store')->name('prediksi-add');
    Route::get('/get/pnj-pro','PerhitunganController@fetchData');
    Route::get('/perhitungan-error','PerhitunganController@error')->name('error');
    Route::get('/error-table','PerhitunganController@fetchError');
    


});
