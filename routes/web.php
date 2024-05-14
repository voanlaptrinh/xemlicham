<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

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
Route::post('/upload-image', [UploadController::class, 'uploadImage'])->name('upload-image');

Route::get('/', function () {
    return view('login.index');
});
Route::get('/home', function () {
    return view('home.content.index');
});
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::prefix('/category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{category}/edit',  [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
    
    Route::prefix('/news')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('news.index');
        Route::get('/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/news', [NewsController::class, 'store'])->name('news.store');
        Route::get('/{news}/edit',  [NewsController::class, 'edit'])->name('news.edit');
        Route::get('/{news}/detail',  [NewsController::class, 'detail'])->name('news.detail');
        Route::put('/{news}/update', [NewsController::class, 'update'])->name('news.update');
        Route::delete('{new}/delete', [NewsController::class, 'destroy'])->name('news.destroy');
    });
    Route::prefix('/account')->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('account.index');
        Route::get('/create', [AccountController::class, 'create'])->name('account.create');
        Route::post('/account', [AccountController::class, 'store'])->name('account.store');
        Route::get('/{user}/edit',  [AccountController::class, 'edit'])->name('account.edit');
        Route::put('/{user}/update', [AccountController::class, 'update'])->name('account.update');
        Route::delete('/{user}/delete', [AccountController::class, 'destroy'])->name('account.destroy');
    });
});





Route::prefix('/login')->group(function () {
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
