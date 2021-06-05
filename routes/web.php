<?php

use App\Http\Controllers\storeController;
use App\Models\Game;
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
        'games' => Game::all(),
    ]);
})->name('games');

Route::get('/information', function () {
    return Inertia::render('Information',[
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'news' => News::all()
    ]);
})->name('information');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [storeController::class,'index'])->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('/games/{id}', [storeController::class,'showGame'])->name('gamepage');
Route::middleware(['auth:sanctum', 'verified'])->get('/users/{id}', [storeController::class,'showUser'])->name('userpage');
Route::middleware(['auth:sanctum', 'verified'])->get('/faqs/{id}', [storeController::class,'chatWithUser'])->name('userchat');

Route::middleware(['auth:sanctum', 'verified'])->post('cart/add', [storeController::class, 'addCart'])->name('addcart');
Route::middleware(['auth:sanctum', 'verified'])->get('cart/delete/{id}', [storeController::class, 'deleteCart'])->name('deletecart');
Route::middleware(['auth:sanctum', 'verified'])->get('/cart/{id}', [storeController::class, 'showCart'])->name('cart');

Route::middleware(['auth:sanctum', 'verified'])->get('/payments/{id}', [storeController::class, 'showPay'])->name('payment');




Route::middleware(['auth:sanctum', 'verified'])->get('/news', function () {
    return Inertia::render('News',[
        'news' => News::all()
    ]);
})->name('news');

Route::middleware(['auth:sanctum', 'verified'])->get('/library', [storeController::class, 'library'])->name('library');




Route::middleware(['auth:sanctum', 'verified'])->get('/support', [storeController::class, 'support'])->name('support');
Route::middleware(['auth:sanctum', 'verified'])->post('/support/add', [storeController::class, 'addFaq'])->name('addFaq');
Route::middleware(['auth:sanctum', 'verified'])->get('/support/respond/{id}', [storeController::class, 'respondFaq'])->name('respondFaq');
