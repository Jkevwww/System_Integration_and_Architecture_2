<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $city = $request->input('city', 'Hinunangan');
        $units = $request->input('units', 'metric');

        // 1. Get Weather Data (Required for everyone)
        $result = $this->weatherService->getWeatherData($city, $units);

        $data = array_merge([
            'city' => $city,
            'units' => $units,
        ], $result);

        // 2. If Admin, add Admin Data to the same view
        if ($user->isAdmin()) {
            $data['users'] = User::all();
            $data['loggedInCount'] = User::count();
            
            $apiUsers = [];
            try {
                $response = Http::timeout(5)->get(url('/api/users'));
                if ($response->successful()) {
                    $apiUsers = $response->json();
                }
            } catch (\Exception $e) {
                $apiUsers = $data['users']->toArray();
            }
            $data['apiUsers'] = $apiUsers;
        }

        return view('dashboard', $data);
    }
}
