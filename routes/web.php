<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/index', [IndexController::class, 'index'])->name('index');
Route::get('/index/fetch-data', [IndexController::class,'fetchData']);


Route::get('/admin', [AdminController::class, 'getBinloc'])->name('admin');
Route::get('/admin/fetch-data',[AdminController::class,'fetchData']);
Route::post('/admin/uploadCsv', [AdminController::class, 'uploadCsv']);
Route::post('/admin/upload', [AdminController::class, 'upload']);
Route::get('/batch', [AdminController::class, 'batch']);
Route::get('/batch/in-progress', [AdminController::class, 'batchInProgress']);