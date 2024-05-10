<?php

namespace App\Http\Controllers;

use App\Models\Api;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ApiController extends Controller
{
    public function index()
    {
        $response = Cache::remember('shopapis', now()->addHour(2), fn () => Http::get('https://hajusrakendus.ta22korva.itmajakas.ee/api/shopapis')->json());
        return view('api.index', ['products' => $response]);
    }

    public function records(): View
    {
        $response = Cache::remember('records', now()->addHour(2), fn () => Http::get('https://hajusrakendus.ta22maarma.itmajakas.ee/api/records')->json());
        return view('api.records', ['products' => $response]);
    }

    public function makeup(): View
    {

        $response = Cache::remember('makeup', now()->addHour(2), fn () => Http::get('https://ralf.ta22sink.itmajakas.ee/api/makeup')->json());
        return view('api.makeup', ['products' => $response]);
    }

    public function movies(): View
    {

        $response = Cache::remember('movies', now()->addHour(2), fn () => Http::get('https://hajus.ta19heinsoo.itmajakas.ee/api/movies')->json());
        return view('api.movies', ['products' => $response['data']]);
    }
}
