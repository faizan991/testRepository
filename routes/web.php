<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');


// Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('edit');

/*
Route::get('/blogs/create', [BlogController::class,'create'])->name('blogs.create');
Route::get('/blogs/{id}', [BlogController::class,'show'])->name('blogs.show');
Route::get('/blogs/edit/{id}', [BlogController::class,'edit'])->name('blogs.edit');
Route::get('/blogs/destroy/{id}', [BlogController::class,'destroy'])->name('blogs.destroy');
*/

// Registered, activated, and is current user routes.
// Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep', 'checkblocked']], function () { 
Route::group(['middleware' => ['auth']], function () { 
    Route::get('/profile/{id}', [ProfileController::class,'show'])->name('profile.show');
});
