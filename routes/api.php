<?php

use App\Http\Controllers\ShopapiController;
use Illuminate\Cache\RateLimiting\Limit;
use App\Models\GardenTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/shopapis', [ShopApiController::class, 'index']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('makeup', function () {
    return Http::get('https://ralf.ta22sink.itmajakas.ee/api/makeup')->json();
    if ($limit = request('limit')) {
        return Cache::remember('my-request-' . $limit, now()->addHour(), fn () => GardenTool::limit($limit)->get());
    }

    return Cache::remember('my-request-' . $limit, now()->addHour(), fn () => GardenTool::limit($limit)->get());
});

Route::get('records', function () {
    return Http::get('https://hajusrakendus.ta22maarma.itmajakas.ee/api/records')->json();
    if ($limit = request('limit')) {
        return Cache::remember('my-request-' . $limit, now()->addHour(), fn () => GardenTool::limit($limit)->get());
    }

    return Cache::remember('my-request-' . $limit, now()->addHour(), fn () => GardenTool::limit($limit)->get());
});

Route::get('movies', function () {
    return Http::get('https://hajus.ta19heinsoo.itmajakas.ee/api/movies')->json();
    if ($limit = request('limit')) {
        return Cache::remember('my-request-' . $limit, now()->addHour(), fn () => GardenTool::limit($limit)->get());
    }

    return Cache::remember('my-request-' . $limit, now()->addHour(), fn () => GardenTool::limit($limit)->get());
});
