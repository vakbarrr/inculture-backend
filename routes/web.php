<?php

use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UsersController;
use App\Models\Tag;

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
    Route::resource('berita', BeritaController::class);
    Route::post('berita/addTags', [BeritaController::class, 'addTags'])->name('berita.addTags');

    Route::post('quickdraft', [BeritaController::class, 'quickDrafts'])->name('berita.quickDraft');

    Route::resource('kategori', KategoriController::class);
    Route::resource('tag', TagController::class);
    Route::resource('halaman', HalamanController::class);

    Route::get('media/modal', 'MediaController@modalshow')->name('media.modal');
    Route::get('media/modal-gallery', 'MediaController@modalShowGallery')->name('media.modal_gallery');
    Route::match(['post', 'patch'], 'media/ajaxstore', 'MediaController@ajaxStore')->name('media.ajaxstore');
    Route::resource('media', MediaController::class);

    Route::get('pdf/modal', 'PdfController@modalshow')->name('pdf.modal');
    Route::post('pdf/ajaxstore', 'PdfController@ajaxStore')->name('pdf.ajaxstore');
    Route::resource('pdf', PdfController::class);

    Route::resource('menu', LayoutController::class);

    Route::post('dmenu/reorder', 'MenuController@reOrder')->name('dmenu.reorder');
    Route::resource('dmenu', 'MenuController');

    Route::resource('slider', SliderController::class);
    Route::resource('users', UsersController::class);
    Route::resource('pesan', PesanController::class);

    Route::delete('setting/deleted', [SettingController::class, 'deleted'])->name('setting.deleted');
    Route::resource('setting', SettingController::class);
});
Route::get('/panelroom',  [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/home', 'HomeController@index')->name('home');
