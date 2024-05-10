<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopapiController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/weather', [WeatherController::class, 'getWeather'])->name('weather');

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::post('/chirps/{chirp}/comments', [ChirpController::class, 'storeComment'])->name('chirps.comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


Route::get('/markers', [MarkerController::class, 'index'])->name('markers.index');
Route::get('/markers/create', [MarkerController::class, 'create'])->name('markers.create');
Route::post('/markers', [MarkerController::class, 'store'])->name('markers.store');
Route::get('/markers/{id}/edit', [MarkerController::class, 'edit'])->name('markers.edit');
Route::put('/markers/{id}', [MarkerController::class, 'update'])->name('markers.update');
Route::delete('/markers/{id}', [MarkerController::class, 'destroy'])->name('markers.destroy');

Route::resource('/store', StoreController::class);
Route::put('/store/{product}', [StoreController::class, 'update'])->name('store.update');
Route::get('/', [ProductsController::class, 'showProducts']);

Route::get('cart', [ProductsController::class, 'showCartTable']);
Route::get('add-to-cart/{id}', [ProductsController::class, 'addToCart']);

Route::delete('remove-from-cart', [ProductsController::class, 'removeCartItem']);
Route::get('clear-cart', [ProductsController::class, 'clearCart']);

Route::get('/shopapi', [ShopapiController::class, 'index'])->name('shopapi.index');
Route::get('/shopapi/create', [ShopapiController::class, 'create'])->name('shopapi.create');
Route::post('/shopapi', [ShopapiController::class, 'store'])->name('shopapi.store');
Route::get('/shopapi/{id}/edit', [ShopapiController::class, 'edit'])->name('shopapi.edit');
Route::put('/shopapi/{id}', [ShopapiController::class, 'update'])->name('shopapi.update');
Route::delete('/shopapi/{id}', [ShopapiController::class, 'destroy'])->name('shopapi.destroy');

Route::get('/api', [ApiController::class, 'index'])->name('api.index');
Route::get('/api/records', [ApiController::class, 'records'])->name('api.records');
Route::get('/api/movies', [ApiController::class, 'movies'])->name('api.movies');
Route::get('/api/makeup', [ApiController::class, 'makeup'])->name('api.makeup');

require __DIR__ . '/auth.php';
