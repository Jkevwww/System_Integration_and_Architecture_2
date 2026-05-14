<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherService
{
    public function getWeatherData($city, $units)
    {
        $apiKey = config('services.openweather.key', env('OPENWEATHER_KEY'));
        
        if (!$apiKey) {
            return ['error' => 'OpenWeather API Key is missing.'];
        }

        // 1. Geocoding
        $geoResponse = Http::get("http://api.openweathermap.org/geo/1.0/direct", [
            'q' => $city,
            'limit' => 1,
            'appid' => $apiKey,
        ]);

        if ($geoResponse->failed() || empty($geoResponse->json())) {
            return ['error' => 'City not found.'];
        }

        $geoData = $geoResponse->json()[0];
        $lat = $geoData['lat'];
        $lon = $geoData['lon'];

        // 2. Current Weather
        $currentResponse = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'lat' => $lat,
            'lon' => $lon,
            'units' => $units,
            'appid' => $apiKey,
        ]);

        // 3. Forecast (5 day / 3 hour)
        $forecastResponse = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
            'lat' => $lat,
            'lon' => $lon,
            'units' => $units,
            'appid' => $apiKey,
        ]);

        if ($currentResponse->failed() || $forecastResponse->failed()) {
            return ['error' => 'Could not retrieve weather data.'];
        }

        $current = $currentResponse->json();
        $forecast = $forecastResponse->json();

        // Process Forecast
        $daily = [];
        $hourly = [];
        
        foreach ($forecast['list'] as $item) {
            $date = Carbon::createFromTimestamp($item['dt'])->format('Y-m-d');
            $hourly[] = [
                'dt' => $item['dt'],
                'temp' => $item['main']['temp'],
                'weather' => $item['weather']
            ];

            if (!isset($daily[$date]) || Carbon::createFromTimestamp($item['dt'])->hour == 12) {
                $daily[$date] = [
                    'dt' => $item['dt'],
                    'temp' => ['day' => $item['main']['temp']],
                    'weather' => $item['weather'],
                    'main' => $item['main']
                ];
            }
        }

        return [
            'weather' => [
                'name' => $current['name'],
                'sys' => ['country' => $current['sys']['country']],
                'lat' => $lat,
                'lon' => $lon,
                'current' => [
                    'temp' => $current['main']['temp'],
                    'feels_like' => $current['main']['feels_like'],
                    'humidity' => $current['main']['humidity'],
                    'pressure' => $current['main']['pressure'],
                    'wind_speed' => $current['wind']['speed'],
                    'visibility' => $current['visibility'] ?? 0,
                    'uvi' => 'N/A',
                    'dew_point' => $this->calculateDewPoint($current['main']['temp'], $current['main']['humidity'], $units),
                    'weather' => $current['weather'],
                ],
                'daily' => array_values($daily),
                'hourly' => $hourly,
            ]
        ];
    }

    private function calculateDewPoint($temp, $humidity, $units)
    {
        $t = ($units === 'imperial') ? ($temp - 32) * 5/9 : $temp;
        $rh = $humidity / 100;
        $a = 17.27;
        $b = 237.7;
        $gamma = (($a * $t) / ($b + $t)) + log($rh);
        $dewC = ($b * $gamma) / ($a - $gamma);
        return ($units === 'imperial') ? ($dewC * 9/5) + 32 : $dewC;
    }
}
