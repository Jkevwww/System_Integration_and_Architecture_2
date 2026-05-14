<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\WeatherService;

class AdminDashboardController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // 1. Weather Data (Admin dashboard should be the same as user dashboard + extras)
        $city = $request->input('city', 'Hinunangan');
        $units = $request->input('units', 'metric');
        $weatherResult = $this->weatherService->getWeatherData($city, $units);

        // 2. User Management
        $users = User::all();
        $loggedInCount = User::count();
        
        // 3. API Consumption
        $apiUsers = [];
        try {
            $response = Http::timeout(5)->get(url('/api/users'));
            if ($response->successful()) {
                $apiUsers = $response->json();
            }
        } catch (\Exception $e) {
            $apiUsers = $users->toArray();
        }
        
        return view('admin.dashboard', array_merge([
            'users' => $users,
            'apiUsers' => $apiUsers,
            'loggedInCount' => $loggedInCount,
            'city' => $city,
            'units' => $units
        ], $weatherResult));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|in:Admin,User',
        ]);

        $user->update([
            'name' => $request->name,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}
