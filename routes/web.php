<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController\WebsiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranMutasiController;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('roles', App\Http\Controllers\RoleController::class);

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);

    Route::get('profil', [App\Http\Controllers\UserController::class,'profil'])->name('profil');
    Route::get('editProfil/{id}', [App\Http\Controllers\UserController::class,'editProfiles']);
    Route::patch('updateProfile/{id}', [App\Http\Controllers\UserController::class,'updateProfile']);

    Route::resource('pageCategories', App\Http\Controllers\PageCategoryController::class);
    Route::post('pageCategoriesIncrease/{id}', 'App\Http\Controllers\PageCategoryController@increase')->name('pageCategoriesIncrease');
    Route::post('pageCategoriesDecrease/{id}', 'App\Http\Controllers\PageCategoryController@decrease')->name('pageCategoriesDecrease');
    Route::resource('posts', App\Http\Controllers\PostController::class);
    Route::resource('pages', App\Http\Controllers\PageController::class);
    Route::resource('postCategories', App\Http\Controllers\PostCategoryController::class);
    Route::resource('agendaCategories', App\Http\Controllers\AgendaCategoryController::class);
    Route::resource('agendas', App\Http\Controllers\AgendaController::class);
    Route::resource('galeris', App\Http\Controllers\GaleriController::class);
    Route::resource('kegiatans', App\Http\Controllers\KegiatanController::class);
    Route::resource('people', App\Http\Controllers\PersonController::class);
    Route::resource('jabatans', App\Http\Controllers\JabatanController::class);
    Route::post('jabatansIncrease/{id}', 'App\Http\Controllers\JabatanController@increase')->name('jabatansIncrease');
    Route::post('jabatansDecrease/{id}', 'App\Http\Controllers\JabatanController@decrease')->name('jabatansDecrease');
    Route::resource('pendidikans', App\Http\Controllers\PendidikanController::class);
    Route::resource('bidangs', App\Http\Controllers\BidangController::class);
    Route::resource('pangkatGolongans', App\Http\Controllers\PangkatGolonganController::class);

    Route::resource('pegawais', App\Http\Controllers\PegawaiController::class);
    Route::resource('pangkats', App\Http\Controllers\PangkatController::class);
    Route::resource('perangkatDaerahs', App\Http\Controllers\PerangkatDaerahController::class);

    Route::get('/pendaftaranMutasis/timeline/{id}', [PendaftaranMutasiController::class, 'timeline'])->name('timeline');
    Route::get('/pendaftaranMutasis/review/{id}', [PendaftaranMutasiController::class, 'review'])->name('review');
    Route::post('/pendaftaranMutasis/review', [PendaftaranMutasiController::class, 'reviewConfirm'])->name('reviewConfirm');
    Route::get('/pendaftaranMutasis/contohImport', [PendaftaranMutasiController::class, 'contohImport'])->name('pendaftaranMutasis.contohImport');
    Route::get('pendaftaranMutasis/export', [PendaftaranMutasiController::class,'export'])->name('pendaftaranMutasis.export');
    Route::get('pendaftaranMutasis/import', [PendaftaranMutasiController::class,'importView'])->name('pendaftaranMutasis.importView');
    Route::post('pendaftaranMutasis/import', [PendaftaranMutasiController::class,'import'])->name('pendaftaranMutasis.import');
    Route::get('pendaftaranMutasis/keputusanMutasi', [PendaftaranMutasiController::class,'keputusanMutasi'])->name('pendaftaranMutasis.keputusanMutasi');
    Route::resource('pendaftaranMutasis', PendaftaranMutasiController::class);
    Route::resource('statuses', App\Http\Controllers\StatusController::class);
    Route::resource('pendaftaranMutasiStatuses', App\Http\Controllers\PendaftaranMutasiStatusController::class);

    Route::resource('sarans', App\Http\Controllers\SaranController::class);
    Route::resource('slideSops', App\Http\Controllers\SlideSopController::class);
    Route::resource('linkSks', App\Http\Controllers\LinkSkController::class);
});

Route::get('/', [WebsiteController::class,'index'])->name('beranda');
