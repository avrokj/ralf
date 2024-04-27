<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopapiController;
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

Route::get('/shopapi', [ShopapiController::class, 'index'])->name('shopapi.index');
Route::get('/shopapi/create', [ShopapiController::class, 'create'])->name('shopapi.create');
Route::post('/shopapi', [ShopapiController::class, 'store'])->name('shopapi.store');
Route::get('/shopapi/{id}/edit', [ShopapiController::class, 'edit'])->name('shopapi.edit');
Route::put('/shopapi/{id}', [ShopapiController::class, 'update'])->name('shopapi.update');
Route::delete('/shopapi/{id}', [ShopapiController::class, 'destroy'])->name('shopapi.destroy');



Route::get('/records', [ApiController::class, 'index'])->name('api.index');

// Route::get('/show-api', function () {
//     return match (request('name')) {
//         'Ralf' => Cache::remember('movies', now()->addHour(), fn () =>
//         Http::get('https://hajus.ta19heinsoo.itmajakas.ee/api/movies')->json()),
//         'Liis' => Cache::remember('tools', now()->addHour(), fn () =>
//         Http::get('https://hajusrakendus.ta22alber.itmajakas.ee/tools')->json()),
//         'Mari-Liis' => Cache::remember('makeup', now()->addHour(), fn () =>
//         Http::get('https://ralf.ta22sink.itmajakas.ee/api/makeup')->json()),
//         default => Cache::remember('records', now()->addHour(), fn () =>
//         Http::get('https://hajusrakendus.ta22maarma.itmajakas.ee/api/records')->json())
//     };
// });


require __DIR__ . '/auth.php';
