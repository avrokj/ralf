<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopapiController;
use App\Http\Controllers\WeatherController;
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


Route::get('/markers', [MarkerController::class, 'index'])->name('markers.index');
Route::get('/markers/create', [MarkerController::class, 'create'])->name('markers.create');
Route::post('/markers', [MarkerController::class, 'store'])->name('markers.store');
Route::get('/markers/{id}/edit', [MarkerController::class, 'edit'])->name('markers.edit');
Route::put('/markers/{id}', [MarkerController::class, 'update'])->name('markers.update');
Route::delete('/markers/{id}', [MarkerController::class, 'destroy'])->name('markers.destroy');

// Route::get('store', [StoreController::class, 'index'])->name('store.index');
Route::get('/', [ProductsController::class, 'showProducts']);

Route::get('cart', [ProductsController::class, 'showCartTable']);
Route::get('add-to-cart/{id}', [ProductsController::class, 'addToCart']);

Route::delete('remove-from-cart', [ProductsController::class, 'removeCartItem']);
Route::get('clear-cart', [ProductsController::class, 'clearCart']);

Route::get('/shopapis', [ShopapiController::class, 'index'])->name('shopapis.index');
Route::get('/shopapis/create', [ShopapiController::class, 'create'])->name('shopapis.create');
Route::post('/shopapis', [ShopapiController::class, 'store'])->name('shopapis.store');
Route::get('/shopapi/{id}/edit', [ShopapiController::class, 'edit'])->name('shopapis.edit');
Route::put('/shopapi/{id}', [ShopapiController::class, 'update'])->name('shopapis.update');
Route::delete('/shopapi/{id}', [ShopapiController::class, 'destroy'])->name('shopapis.destroy');


require __DIR__ . '/auth.php';
