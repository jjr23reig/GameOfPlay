<?php

use App\Http\Controllers\storeController;
use App\Models\News;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('games');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [storeController::class,'index'])->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('/games/{id}', [storeController::class,'showGame'])->name('gamepage');
Route::middleware(['auth:sanctum', 'verified'])->get('/users/{id}', [storeController::class,'showUser'])->name('userpage');

Route::middleware(['auth:sanctum', 'verified'])->post('cart/add', [storeController::class, 'addCart'])->name('addcart');
Route::middleware(['auth:sanctum', 'verified'])->get('cart/delete/{id}', [storeController::class, 'deleteCart'])->name('deletecart');
Route::middleware(['auth:sanctum', 'verified'])->get('/cart/{id}', [storeController::class, 'showCart'])->name('cart');

Route::middleware(['auth:sanctum', 'verified'])->get('/payments/{id}', [storeController::class, 'showPay'])->name('payment');




Route::middleware(['auth:sanctum', 'verified'])->get('/news', function () {
    return Inertia::render('News',[
        'news' => News::all()
    ]);
})->name('news');

Route::middleware(['auth:sanctum', 'verified'])->get('/support', function () {
    return Inertia::render('Support');
})->name('support');
