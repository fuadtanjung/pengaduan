<?php

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
//
//Route::get('/', function () {
//    //
//})->middleware('auth');

Route::group(['prefix' => ''], function(){
    Route::get('/','PengaduanController@index');
    Route::post('input','PengaduanController@input');
});

Auth::routes();
Route::middleware('auth')->group(function () {
        Route::group(['prefix' => 'admin'], function(){
            Route::get('/','PengajuanController@index');
            Route::get('data', 'PengajuanController@ajaxTable');
            Route::post('edit/{id}', 'PengajuanController@edit');
            Route::post('change/{id}', 'PengajuanController@changeStatus');
            Route::post('delete/{id}', 'PengajuanController@delete');
            Route::get('listkategori', 'PengajuanController@listKategori');
            Route::get('listtipe', 'PengajuanController@listTipe');
            Route::get('listuser', 'PengajuanController@listUser');
            Route::get('listurgensi', 'PengajuanController@listUrgensi');
            Route::get('listprioritas', 'PengajuanController@listPrioritas');
            Route::get('listjenis', 'PengajuanController@listJenis');
            Route::get('listdampak', 'PengajuanController@listDampak');
            Route::get('listpetugas', 'PengajuanController@listPetugas');
    });

    Route::group(['prefix' => 'laporan'], function(){
        Route::get('/', 'PenyelesaianController@index');
        Route::get('/data', 'PenyelesaianController@ajaxtable');
        Route::post('input','PenyelesaianController@input');
        Route::get('listkategori', 'PenyelesaianController@listKategori');
        Route::get('listtipe', 'PenyelesaianController@listTipe');
        Route::get('listuser', 'PenyelesaianController@listUser');
        Route::get('listurgensi', 'PenyelesaianController@listUrgensi');
        Route::get('listprioritas', 'PenyelesaianController@listPrioritas');
        Route::get('listjenis', 'PenyelesaianController@listJenis');
        Route::get('listdampak', 'PenyelesaianController@listDampak');
        Route::get('listpetugas', 'PenyelesaianController@listPetugas');
        Route::get('/rekap', 'PenyelesaianController@rekap');
    });

    Route::group(['prefix' => 'rekap'], function(){
        Route::post('/', 'RekapController@semua');
        Route::get('hasil/{id}', 'RekapController@laporan')->name('info');
    });

    Route::group(['prefix' => 'user'], function(){
        Route::get('/','UserController@index');
        Route::get('data', 'UserController@ajaxTable');
        Route::post('input','UserController@input');
        Route::post('edit/{id}', 'UserController@edit');
        Route::post('delete/{id}', 'UserController@delete');
    });

    Route::group(['prefix' => 'dampak'], function(){
        Route::get('/','DampakController@index');
        Route::get('data', 'DampakController@ajaxTable');
        Route::post('input','DampakController@input');
        Route::post('edit/{id}', 'DampakController@edit');
        Route::post('delete/{id}', 'DampakController@delete');
    });

    Route::group(['prefix' => 'jenis'], function(){
        Route::get('/','JenisController@index');
        Route::get('data', 'JenisController@ajaxTable');
        Route::post('input','JenisController@input');
        Route::post('edit/{id}', 'JenisController@edit');
        Route::post('delete/{id}', 'JenisController@delete');
    });

    Route::group(['prefix' => 'petugas'], function(){
        Route::get('/','PetugasController@index');
        Route::get('data', 'PetugasController@ajaxTable');
        Route::post('input','PetugasController@input');
        Route::post('edit/{id}', 'PetugasController@edit');
        Route::post('delete/{id}', 'PetugasController@delete');
    });

    Route::group(['prefix' => 'urgensi'], function(){
        Route::get('/','UrgensiController@index');
        Route::get('data', 'UrgensiController@ajaxTable');
        Route::post('input','UrgensiController@input');
        Route::post('edit/{id}', 'UrgensiController@edit');
        Route::post('delete/{id}', 'UrgensiController@delete');
    });

    Route::group(['prefix' => 'prioritas'], function(){
        Route::get('/','PrioritasController@index');
        Route::get('data', 'PrioritasController@ajaxTable');
        Route::post('input','PrioritasController@input');
        Route::post('edit/{id}', 'PrioritasController@edit');
        Route::post('delete/{id}', 'PrioritasController@delete');
    });

    Route::group(['prefix' => 'tipe'], function(){
        Route::get('/','TipeController@index');
        Route::get('data', 'TipeController@ajaxTable');
        Route::post('input','TipeController@input');
        Route::post('edit/{id}', 'TipeController@edit');
        Route::post('delete/{id}', 'TipeController@delete');
    });

    Route::group(['prefix' => 'kategori'], function(){
        Route::get('/','KategoriController@index');
        Route::get('data', 'KategoriController@ajaxTable');
        Route::post('input','KategoriController@input');
        Route::post('edit/{id}', 'KategoriController@edit');
        Route::post('delete/{id}', 'KategoriController@delete');
    });

});




Route::get('/home', 'HomeController@index')->name('home');



