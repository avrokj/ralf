<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
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
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                ],
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            if ($httpCode >= 200 && $httpCode < 300) {
                $data = json_decode($response, true);

                $cachedAt = Carbon::now();
                Cache::put('weather_data', ['data' => $data, 'cached_at' => $cachedAt], now()->addHours(2));

                return view('weather', ['weatherData' => $data, 'cachedAt' => $cachedAt]);
            } else {
                throw new \Exception('Failed to fetch weather data. HTTP code: ' . $httpCode);
            }
        } catch (\Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }
}
