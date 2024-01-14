<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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

/*Route::get('/', function () {
    return view('welcome');
});*/
/*Route::group(['middleware' => 'auth'], function () {
    Route::get('/',[PostController::class,'index']);
    Route::get('posts/create',[PostController::class,'create'])->name('posts.create');
    Route::get('posts',[PostController::class,'index'])->name('posts.index');
    Route::post('posts',[PostController::class,'store'])->name('posts.store');
    Route::get('posts/{post}',[PostController::class,'show'])->name('posts.show');
    Route::get('posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::put('posts/{post}',[PostController::class,'update'])->name('posts.update');
    Route::delete('posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');
    Route::resource('posts', PostController::class);
    
});

Route::group(['middleware' => 'gueast'], function () {
    Route::get('/login', ['Auth\AuthController@showLoginForm'])->name('login');
    Route::post('/login', ['Auth\AuthController@login']); 
    Route::get('/register', ['Auth\AuthController@showRegistrationForm'])->name('register');
    Route::post('/register', ['Auth\AuthController@register']); 

    
});*/


// Routes accessible to authenticated users
Route::middleware(['auth'])->group(function () {
 Route::get('/', [PostController::class, 'index']);
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('posts',[ PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{post}',[ PostController::class, 'show'])->name('posts.show');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/logout',[ AuthController::class, 'logout'])->name('logout');
});
   
// Routes accessible to guests (non-authenticated users)
Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login',[ AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register',[ AuthController::class, 'register']);
});


Route::group(['middleware' => 'guest'], function () {
    
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});
//