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

Route::get('/', 'Frontend\FrontendController@home')->name('home');
Route::get('/produk/{id}', 'Frontend\FrontendController@detail')->name('detail');

Route::get('/login', 'Auth\AuthController@login')->name('login');
Route::get('/daftar', 'Auth\AuthController@register')->name('register');
Route::post('/post-daftar', 'Auth\AuthController@postRegister')->name('post-register');
Route::get('/verify-account/{id}', 'Auth\AuthController@verifyAccount')->name('verify-account');
Route::post('/check-login', 'Auth\AuthController@checkLogin')->name('check-login');
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

Route::group(['prefix' => 'index', 'middleware' => 'auth:karyawan'], function () {
    Route::get('/dashboard', 'Backend\DashboardController@index')->name('dashboard-karyawan');
    Route::resource('/data/kategori', 'Backend\KategoriController');
    Route::resource('/data/produk', 'Backend\ProdukController');
    Route::resource('/data/tentang', 'Backend\TentangController');
    Route::resource('/data/metode-pembayaran', 'Backend\MetodePembayaranController');
    Route::resource('/data/user', 'Backend\UserController');
    Route::resource('/data/karyawan', 'Backend\KaryawanController');
    Route::resource('/transaksi', 'Backend\TransaksiController');
    Route::resource('/detail-transaksi', 'Backend\DetailTransaksiController');
    Route::resource('/detail-produk', 'Backend\DetailProdukController');

    Route::get('/laporan', 'Backend\LaporanController@index')->name('laporan-index');
    Route::get('/laporan/invoice/{id}', 'Backend\LaporanController@printInvoiceLaporan')->name('laporan-invoice');
    Route::post('/laporan/filter', 'Backend\LaporanController@filterDate')->name('laporan-filter');
    Route::post('/laporan/printLaporan', 'Backend\LaporanController@printLaporan')->name('laporan-print');

    Route::post('/download-file-keranjang', 'Backend\DownloadFileController@downloadFotoDesainKeranjang')->name('download-foto-desain-keranjang');
    Route::post('/uploadBukti', 'Backend\TransaksiController@uploadBukti')->name('uploadBukti');
    Route::get('/verify-acc-transaksi/{id}', 'Backend\TransaksiController@verifyACC')->name('verify-acc-transaksi');
    Route::get('/verify-reject-transaksi/{id}', 'Backend\TransaksiController@verifyReject')->name('verify-reject-transaksi');
    Route::get('/verify-end-transaksi/{id}', 'Backend\TransaksiController@verifyEnd')->name('verify-end-transaksi');
    Route::post('/transaksi-download-file', 'Backend\TransaksiController@downloadFile')->name('download-file');
    Route::get('/printInvoice-backend/{id}', 'Backend\TransaksiController@printInvoice')->name('printInvoice-backend');

    Route::get('/setting', 'Backend\DashboardController@settingProfile')->name('setting-profile-admin');
    Route::post('/setting-post', 'Backend\DashboardController@settingProfilePost')->name('setting-profile-admin-post');
});


Route::group(['prefix' => 'index', 'middleware' => 'auth:user'], function () {
    Route::get('/user', 'Backend\DashboardUserController@index')->name('dashboard-user');
    Route::post('/user/checkout', 'Backend\DashboardUserController@checkout')->name('dashboard-checkout');
    Route::post('/user/download-file-keranjang', 'Backend\DashboardUserController@downloadFile')->name('download-file-user');
    Route::post('/user/download-file-transaksi', 'Backend\DashboardUserController@dowloadFileTransaksi')->name('download-file-transaksi-user');
    Route::post('/user/processCheckout', 'Backend\DashboardUserController@processCheckout')->name('process-checkout');
    Route::delete('/user/delete-checkout/{id}', 'Backend\DashboardUserController@deleteCheckout')->name('delete-checkout');
    Route::get('/user/detail-transaksi/{id}', 'Backend\DashboardUserController@detailTransaksi')->name('detail-transaksi');
    Route::post('/user/uploadBuktiPembayaran', 'Backend\DashboardUserController@uploadBuktiPembayaran')->name('upload-bukti-pembayaran');
    Route::get('/user/cetakInvoiceUser/{id}', 'Backend\DashboardUserController@cetakInvoiceUser')->name('cetak-invoice-user');
    Route::get('/user/settingUser', 'Backend\DashboardUserController@settingUser')->name('user-setting');
    Route::post('/user/settingProfilePost', 'Backend\DashboardUserController@settingUserChange')->name('setting-profile-user');
});

// Route::group(['prefix' => 'user', 'middleware' => 'auth:user'], function () {
//     Route::get('/dashboard', 'Frontend\DashboardUserController@dashboard')->name('dashboard-user');
// });
