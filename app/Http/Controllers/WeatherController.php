<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherController extends Controller
{
    public function getWeather()
    {
        $cachedWeatherData = Cache::get('weather_data');

        if ($cachedWeatherData && isset($cachedWeatherData['data'])) {
            $weatherData = $cachedWeatherData['data'];
            $cachedAt = $cachedWeatherData['cached_at'];
            return view('weather', ['weatherData' => $weatherData, 'cachedAt' => $cachedAt]);
        }

        $apiKey = config('services.weather.key');
        $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=Kuressaare&units=metric&appid={$apiKey}";

        try {
            $response = Http::get($apiUrl); // Make a GET request to the API

            $data = $response->json(); // Get the response body as JSON

            $cachedAt = Carbon::now();
            Cache::put('weather_data', ['data' => $data, 'cached_at' => $cachedAt], now()->addHours(2));

            return view('weather', ['weatherData' => $data, 'cachedAt' => $cachedAt]);
        } catch (\Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }
}
