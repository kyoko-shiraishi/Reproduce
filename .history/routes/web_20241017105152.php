<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PleaseController; 
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\LikeController;

// ララベルトップルート
Route::get('/', function () { 
    return view('welcome'); 
});

// トップページ
Route::get('/index', [PleaseController::class, 'index'])->name('index');

// ログインページのルート
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

// ログイン処理のルート
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// 登録ページのルート
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// 登録処理のルート
Route::post('/register', [RegisteredUserController::class, 'store']);

// ダッシュボードのルート
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




// 認証が必要なルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// ホームページのルート
Route::get('/home',[PleaseController::class,'home'])->name('home');



require __DIR__.'/auth.php';

Route::get('/business',[PleaseController::class,'business'])->name('business');
Route::get('/infomation',[PleaseController::class,'infomation'])->name('infomation');
Route::get('/logo',[PleaseController::class,'logo'])->name('logo');

Route::get('/search',[SearchController::class,'search'])->name('search.results');
Route::get('/post/{id}',[PostController::class,'post'])->name('post');
Route::get('/new_thread_create',[PleaseController::class,'new_thread_create'])->name('new_thread_create');


Route::post('/thread_store',[NewController::class,'thread_store'])->name('thread_store');
Route::get('/new_post_create/{id}', [NewController::class, 'new_post_create'])->name('new_post_create');

Route::post('/post_store/{threadId}', [NewController::class, 'post_store'])->name('post_store');
Route::get('/delete',[PleaseController::class,'delete_show'])->name('delete_show');
Route::post('/delete_selected',[PleaseController::class,'delete_selected'])->name('delete_selected');

Route::post('/thread/like', [LikeController::class, 'likeThread']);



