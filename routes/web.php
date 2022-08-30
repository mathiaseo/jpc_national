<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;

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

Route::get('/', [DefaultController::class, 'index']);









Route::resource('post', App\Http\Controllers\PostController::class);

Route::resource('comment', App\Http\Controllers\CommentController::class);

Route::resource('region', App\Http\Controllers\RegionController::class);

Route::resource('circonscription', App\Http\Controllers\CirconscriptionController::class);

Route::resource('secteur', App\Http\Controllers\SecteurController::class);

Route::resource('localite', App\Http\Controllers\LocaliteController::class);

Route::resource('jeune', App\Http\Controllers\JeuneController::class);

Route::resource('image_gallery', App\Http\Controllers\Image_galleryController::class);
