<x-app-layout>
    <div class="relative min-h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1592210454359-9043f067919b?q=80&w=2070&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        <div class="relative z-10 p-4 sm:p-6 lg:p-8 text-white max-w-7xl mx-auto">

            {{-- Top Bar: Welcome, Location, Search --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 bg-white/5 p-6 rounded-3xl backdrop-blur-md border border-white/10">
                <div class="text-center md:text-left">
                    <h1 class="text-3xl font-black tracking-tight">Welcome, {{ Auth::user()->name }}!</h1>
                    <p class="text-indigo-300 font-bold uppercase tracking-wider text-xs">Role: {{ Auth::user()->role }} Dashboard</p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                    <form method="GET" action="{{ route('dashboard') }}" class="flex items-center w-full sm:w-80">
                        <input type="text" name="city" value="{{ $city ?? '' }}" placeholder="Search City..." class="w-full bg-white/20 border-0 rounded-l-xl py-2.5 px-4 text-white placeholder-gray-300 focus:ring-2 focus:ring-indigo-500 backdrop-blur-md">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 rounded-r-xl py-2.5 px-4 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>

                    <div class="flex bg-white/20 rounded-xl p-1 backdrop-blur-md">
                        <a href="{{ route('dashboard', ['city' => $city, 'units' => 'metric']) }}" class="px-4 py-1.5 rounded-lg text-sm font-black transition-all {{ $units == 'metric' ? 'bg-indigo-600 shadow-lg' : 'hover:bg-white/10' }}">°C</a>
                        <a href="{{ route('dashboard', ['city' => $city, 'units' => 'imperial']) }}" class="px-4 py-1.5 rounded-lg text-sm font-black transition-all {{ $units == 'imperial' ? 'bg-indigo-600 shadow-lg' : 'hover:bg-white/10' }}">°F</a>
                    </div>
                </div>
            </div>

            @if (isset($weather) && !isset($error))
                {{-- Location Header --}}
                <div class="flex items-center justify-center mb-8 font-semibold text-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>{{ $weather['name'] }}, {{ $weather['sys']['country'] }}</span>
                </div>

                {{-- Daily Forecast Row --}}
                <div class="flex space-x-4 overflow-x-auto pb-6 mb-8 scrollbar-hide">
                    @foreach ($weather['daily'] as $index => $day)
                        <div class="flex-shrink-0 text-center bg-white/10 hover:bg-white/20 transition-all rounded-2xl p-4 w-32 backdrop-blur-md border border-white/10">
                            <p class="font-bold text-gray-300 mb-2">{{ $index == 0 ? 'Today' : \Carbon\Carbon::createFromTimestamp($day['dt'])->format('D j') }}</p>
                            <img src="http://openweathermap.org/img/wn/{{ $day['weather'][0]['icon'] }}@2x.png" alt="weather icon" class="w-16 h-16 mx-auto">
                            <p class="text-2xl font-black mt-2">{{ round($day['temp']['day']) }}°</p>
                            <p class="text-xs text-gray-400">{{ $day['weather'][0]['main'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                    {{-- Left Panel: Current Weather --}}
                    <div class="lg:col-span-1 bg-white/10 rounded-3xl p-8 backdrop-blur-xl border border-white/20 shadow-2xl">
                        <div class="text-center mb-10">
                            <img src="http://openweathermap.org/img/wn/{{ $weather['current']['weather'][0]['icon'] }}@4x.png" alt="icon" class="w-32 h-32 mx-auto">
                            <p class="text-8xl font-black tracking-tighter">{{ round($weather['current']['temp']) }}°</p>
                            <p class="text-2xl font-light text-indigo-100 mt-2 capitalize">{{ $weather['current']['weather'][0]['description'] }}</p>
                            <p class="text-md text-gray-400 mt-1 italic">Feels like {{ round($weather['current']['feels_like']) }}°</p>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 rounded-2xl p-4 border border-white/5">
                                <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Wind</p>
                                <p class="text-lg font-black">{{ $weather['current']['wind_speed'] }} {{ $units == 'metric' ? 'm/s' : 'mph' }}</p>
                            </div>
                            <div class="bg-white/5 rounded-2xl p-4 border border-white/5">
                                <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Humidity</p>
                                <p class="text-lg font-black">{{ $weather['current']['humidity'] }}%</p>
                            </div>
                            <div class="bg-white/5 rounded-2xl p-4 border border-white/5">
                                <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Visibility</p>
                                <p class="text-lg font-black">{{ round($weather['current']['visibility'] / 1000, 1) }} km</p>
                            </div>
                            <div class="bg-white/5 rounded-2xl p-4 border border-white/5">
                                <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Pressure</p>
                                <p class="text-lg font-black">{{ $weather['current']['pressure'] }} hPa</p>
                            </div>
                            <div class="bg-white/5 rounded-2xl p-4 border border-white/5">
                                <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">UV Index</p>
                                <p class="text-lg font-black text-orange-400">{{ $weather['current']['uvi'] }}</p>
                            </div>
                            <div class="bg-white/5 rounded-2xl p-4 border border-white/5">
                                <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Dew Point</p>
                                <p class="text-lg font-black">{{ round($weather['current']['dew_point']) }}°</p>
                            </div>
                        </div>
                    </div>

                    {{-- Right Panel: Hourly Forecast & Map --}}
                    <div class="lg:col-span-2 flex flex-col gap-8">
                        <div class="bg-white/10 rounded-3xl p-8 backdrop-blur-xl border border-white/20 shadow-2xl">
                            <h3 class="text-xl font-bold mb-6 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Hourly Forecast (24h)
                            </h3>
                            <div class="w-full h-64">
                                <canvas id="hourly-chart"></canvas>
                            </div>
                        </div>

                        <div class="bg-white/10 rounded-3xl p-4 backdrop-blur-xl border border-white/20 shadow-2xl min-h-[400px]">
                            <iframe 
                                width="100%" 
                                height="100%" 
                                class="rounded-2xl border-0"
                                loading="lazy" 
                                allowfullscreen 
                                src="https://www.google.com/maps/embed/v1/place?key={{ config('services.google_maps.key') }}&q={{ $weather['lat'] }},{{ $weather['lon'] }}&zoom=10">
                            </iframe>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex flex-col justify-center items-center h-[50vh]">
                    <div class="bg-white/10 p-8 rounded-3xl backdrop-blur-xl border border-white/20 text-center max-w-lg">
                        <p class="text-xl font-bold mb-4">{{ $error ?? 'Weather data unavailable. Please check your API key.' }}</p>
                        <a href="{{ route('dashboard') }}" class="bg-indigo-600 px-6 py-2 rounded-xl font-black">Retry</a>
                    </div>
                </div>
            @endif

            {{-- ADMIN SECTION (ONLY FOR ADMINS) --}}
            @if (Auth::user()->isAdmin())
                <div class="space-y-8 mt-12 animate-fade-in-up">
                    <div class="bg-slate-900/80 rounded-[2.5rem] p-10 border border-indigo-500/30 backdrop-blur-2xl shadow-2xl">
                        <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-6">
                            <h2 class="text-3xl font-black flex items-center uppercase tracking-tighter text-white">
                                <span class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center mr-4 shadow-lg shadow-indigo-500/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </span>
                                Admin User Controls
                            </h2>
                            <div class="bg-white/5 px-6 py-2 rounded-2xl border border-white/10">
                                <p class="text-[10px] font-bold uppercase text-indigo-300">Registered Accounts</p>
                                <p class="text-xl font-black text-white">{{ $loggedInCount ?? 0 }} Users</p>
                            </div>
                        </div>

                        <div class="overflow-x-auto rounded-3xl border border-white/5 bg-white/5">
                            <table class="w-full text-left">
                                <thead class="bg-indigo-600/80 text-white uppercase font-black tracking-widest text-[10px]">
                                    <tr>
                                        <th class="px-8 py-5">Full Name</th>
                                        <th class="px-8 py-5">Role</th>
                                        <th class="px-8 py-5 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5 text-gray-200">
                                    @if(isset($users))
                                        @foreach ($users as $user)
                                        <tr class="hover:bg-white/10 transition-colors">
                                            <td class="px-8 py-5">
                                                <p class="font-black text-lg">{{ $user->full_name ?? $user->name }}</p>
                                                <p class="text-xs text-indigo-300/60 font-medium">{{ $user->email }}</p>
                                            </td>
                                            <td class="px-8 py-5">
                                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black {{ $user->role === 'Admin' ? 'bg-indigo-500/20 text-indigo-400 border border-indigo-500/30' : 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' }}">
                                                    {{ $user->role }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-5 text-right">
                                                <div class="flex justify-end gap-3">
                                                    <a href="{{ route('admin.users.edit', $user) }}" class="p-2.5 hover:bg-white/10 rounded-xl text-indigo-400 transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="p-2.5 hover:bg-red-500/20 rounded-xl text-red-400">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Internal API Output --}}
                    <div class="bg-indigo-950/50 rounded-[2.5rem] p-10 border border-indigo-500/20 shadow-xl backdrop-blur-3xl">
                        <h3 class="text-sm font-black text-indigo-300 uppercase tracking-[0.2em] mb-8 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                            Live Internal API Data (/api/users)
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            @if(isset($apiUsers))
                                @foreach ($apiUsers as $apiUser)
                                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 hover:scale-105 transition-all">
                                    <p class="text-white font-black text-lg truncate mb-1">{{ $apiUser['full_name'] ?? $apiUser['name'] }}</p>
                                    <p class="text-[10px] text-indigo-300 font-bold uppercase tracking-widest opacity-60">{{ $apiUser['role'] }}</p>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (isset($weather) && !isset($error))
                const hourlyCtx = document.getElementById('hourly-chart').getContext('2d');
                const gradient = hourlyCtx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(99, 102, 241, 0.5)');
                gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

                const hourlyLabels = @json(collect($weather['hourly'])->slice(0, 24)->map(fn($h) => \Carbon\Carbon::createFromTimestamp($h['dt'])->format('g a')));
                const hourlyData = @json(collect($weather['hourly'])->slice(0, 24)->pluck('temp'));

                new Chart(hourlyCtx, {
                    type: 'line',
                    data: {
                        labels: hourlyLabels,
                        datasets: [{
                            label: 'Temp',
                            data: hourlyData,
                            borderColor: '#818cf8',
                            borderWidth: 4,
                            pointRadius: 4,
                            pointBackgroundColor: '#818cf8',
                            pointBorderColor: '#fff',
                            tension: 0.4,
                            fill: true,
                            backgroundColor: gradient,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.6)', font: { weight: 'bold', size: 10 } } },
                            y: { grid: { color: 'rgba(255,255,255,0.1)' }, ticks: { color: 'rgba(255,255,255,0.6)', font: { weight: 'bold', size: 10 } } }
                        }
                    }
                });
            @endif
        });
    </script>
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
    </style>
    @endpush
</x-app-layout>
