<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
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


Auth::routes();
Route::group(['prefix' => 'panelroom'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('berita/addTags', 'BeritaController@addTags')->name('berita.addTags');

    Route::post('quickdraft', 'BeritaController@quickDraft')->name('berita.quickDraft');

    Route::resource('berita', 'BeritaController');
    Route::resource('kategori', 'KategoriController');
    Route::resource('tag', 'TagController');
    Route::resource('halaman', 'HalamanController');

    Route::get('media/modal', 'MediaController@modalshow')->name('media.modal');
    Route::get('media/modal-gallery', 'MediaController@modalShowGallery')->name('media.modal_gallery');
    Route::match(['post', 'patch'], 'media/ajaxstore', 'MediaController@ajaxStore')->name('media.ajaxstore');
    Route::resource('media', 'MediaController');

    Route::get('pdf/modal', 'PdfController@modalshow')->name('pdf.modal');
    Route::post('pdf/ajaxstore', 'PdfController@ajaxStore')->name('pdf.ajaxstore');
    Route::resource('pdf', 'PdfController');

    Route::resource('menu', 'LayoutController');

    Route::post('dmenu/reorder', 'MenuController@reOrder')->name('dmenu.reorder');
    Route::resource('dmenu', 'MenuController');

    Route::get('agenda/getAgenda', 'AgendaController@getAgenda');
    Route::resource('agenda', 'AgendaController');

    Route::resource('slider', 'SliderController');
    Route::resource('users', 'UsersController');
    Route::resource('pengumuman', 'PengumumanController');
    Route::resource('pesan', 'PesanController');
    Route::resource('gallery', 'GalleryController');
    Route::resource('iklan', 'IklanController');
    Route::delete('setting/deleted', [SettingController::class, 'deleted'])->name('setting.deleted');
    Route::resource('setting', 'App\Http\Controllers\SettingController');
});
Route::get('/panelroom',  [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/home', 'HomeController@index')->name('home');
