<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\DB;

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

//API
Route::get('/news/array',[NewsController::class, 'getNewsArray'])->name('news_array');
Route::post('/news/create', [NewsController::class, 'create'])->name('news_create');
Route::post('/news/update/{id}', [NewsController::class, 'update'])->name('news_update');
Route::delete('/news/delete/{id}', [NewsController::class, 'delete'])->name('news_delete');
Route::post('/comment/create', [CommentController::class, 'store'])->name('comment_create');

//utility
Route::get('/api/token', function () {
    return csrf_token();
});
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
