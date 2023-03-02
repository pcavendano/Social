<?php

use App\Http\Controllers\EtudiantController;
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

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ForumPostController ;

Route::get('forum', [ForumPostController::class, 'index'])->name('forum.index')->middleware('auth');
Route::get('forum/{forumPost}', [ForumPostController::class, 'show'])->name('forum.show')->middleware('auth');
Route::get('forum-create', [ForumPostController::class, 'create'])->name('forum.create')->middleware('auth');
Route::post('forum-create', [ForumPostController::class, 'store'])->name('forum.store')->middleware('auth');
Route::get('forum-edit/{vPost}', [ForumPostController::class, 'edit'])->name('forum.edit')->middleware('auth');
Route::put('forum-edit/{forumPost}', [ForumPostController::class, 'update'])->middleware('auth');
Route::delete('forum-edit/{forumPost}', [ForumPostController::class, 'destroy'])->name('forum.delete')->middleware('auth');
Route::delete('forum', [ForumPostController::class, 'destroy'])->name('forum.delete')->middleware('auth');
Route::get('/forum-pdf/{forumPost}', [ForumPostController::class, 'pdf'])->name('forum.pdf')->middleware('auth');

//test eloquent
Route::get('query', [ForumPostController::class, 'query']);
Route::get('page', [ForumPostController::class, 'page']);

use App\Http\Controllers\CustomAuthController;

Route::get('registration', [CustomAuthController::class, 'create'])->name('user.create');
Route::post('registration', [CustomAuthController::class, 'store'])->name('user.store');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('login', [CustomAuthController::class, 'authentication'])->name('user.auth');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');

Route::get('forgot-password', [CustomAuthController::class, 'forgotPassword'])->name('forgot.pass');
Route::post('forgot-password', [CustomAuthController::class, 'tempPassword'])->name('temp.pass');
Route::get('new-password/{user}/{tempPassword}', [CustomAuthController::class, 'newPassword'])->name('new.pass');
Route::post('new-password/{user}/{tempPassword}', [CustomAuthController::class, 'storeNewPassword'])->name('store.pass');

use App\Http\Controllers\LocalizationController;
Route::get('/lang/{locale}', [LocalizationController::class, 'index'])->name('lang');



/*
 * Routes pour les étudiants
 *
 */
Route::get('etudiant', [EtudiantController::class
    , 'index'])->name('etudiants')->middleware('auth');

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/ajouter-etudiant', 'EtudiantController@create')->name('ajouter-etudiant.index');
    Route::post('/ajouter-etudiant', 'EtudiantController@store')->name('ajouter-etudiant.post');
});


//Route::view('/etudiants/creer/etudiant', 'etudiants.create', ['villes' => VilleController::index()]);

Route::get('/etudiant/{etudiant}', [EtudiantController::class
    , 'show']);

Route::post('/etudiants/creer/etudiant', [EtudiantController::class
    , 'create']);

Route::delete('/etudiant/{etudiant}', [EtudiantController::class
    , 'destroy'])->name('effacer-etudiant.delete');

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/modifier-etudiant/{etudiant}', 'EtudiantController@edit')->name('modifier-etudiant.index');
    Route::put('/modifier-etudiant/{etudiant}', 'EtudiantController@update')->name('modifier-etudiant.put');
});
