<x-app-layout>
    <div class="relative min-h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1592210454359-9043f067919b?q=80&w=2070&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        <div class="relative z-10 p-4 sm:p-6 lg:p-8 text-white max-w-7xl mx-auto">

            {{-- Admin Stats Overlay --}}
            <div class="bg-indigo-900/40 border border-indigo-500/30 rounded-3xl p-6 mb-8 backdrop-blur-xl shadow-2xl">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-center md:text-left">
                        <h1 class="text-3xl font-black tracking-tight">Admin Control Panel</h1>
                        <p class="text-indigo-300 font-bold uppercase tracking-widest text-xs mt-1">
                            Welcome! {{ Auth::user()->name }} — Role: {{ Auth::user()->role }}
                        </p>
                    </div>
                    
                    <div class="flex flex-wrap justify-center gap-4">
                        <div class="bg-white/10 rounded-2xl px-6 py-2 border border-white/10 text-center">
                            <p class="text-[10px] font-bold uppercase text-indigo-300">Total Registered</p>
                            <p class="text-xl font-black">{{ $loggedInCount }} Users</p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-4">
                            <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center w-64">
                                <input type="text" name="city" value="{{ $city ?? '' }}" placeholder="Search City..." class="w-full bg-white/10 border-0 rounded-l-xl py-2 px-4 text-white placeholder-gray-400 text-sm focus:ring-1 focus:ring-indigo-500">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 rounded-r-xl py-2 px-4 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </form>
                            <div class="flex bg-white/10 rounded-xl p-1">
                                <a href="{{ route('admin.dashboard', ['city' => $city, 'units' => 'metric']) }}" class="px-3 py-1 rounded-lg text-xs font-black {{ $units == 'metric' ? 'bg-indigo-600' : '' }}">°C</a>
                                <a href="{{ route('admin.dashboard', ['city' => $city, 'units' => 'imperial']) }}" class="px-3 py-1 rounded-lg text-xs font-black {{ $units == 'imperial' ? 'bg-indigo-600' : '' }}">°F</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($weather) && !isset($error))
                {{-- Weather Section (Same as User Dashboard) --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                    {{-- Left: Current Weather --}}
                    <div class="lg:col-span-1 bg-white/10 rounded-3xl p-8 backdrop-blur-xl border border-white/20 shadow-2xl">
                         <div class="text-center">
                            <img src="http://openweathermap.org/img/wn/{{ $weather['current']['weather'][0]['icon'] }}@4x.png" alt="icon" class="w-24 h-24 mx-auto">
                            <p class="text-6xl font-black tracking-tighter">{{ round($weather['current']['temp']) }}°</p>
                            <p class="text-xl font-light text-indigo-100 mt-1 capitalize">{{ $weather['current']['weather'][0]['description'] }}</p>
                            <div class="mt-6 flex items-center justify-center font-bold text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                {{ $weather['name'] }}, {{ $weather['sys']['country'] }}
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mt-8 text-xs">
                            <div class="bg-white/5 rounded-xl p-3 border border-white/5">
                                <p class="text-gray-400 font-bold uppercase mb-1">Humidity</p>
                                <p class="text-md font-black">{{ $weather['current']['humidity'] }}%</p>
                            </div>
                            <div class="bg-white/5 rounded-xl p-3 border border-white/5">
                                <p class="text-gray-400 font-bold uppercase mb-1">Wind</p>
                                <p class="text-md font-black">{{ $weather['current']['wind_speed'] }} {{ $units == 'metric' ? 'm/s' : 'mph' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Hourly Graph --}}
                    <div class="lg:col-span-2 bg-white/10 rounded-3xl p-8 backdrop-blur-xl border border-white/20 shadow-2xl">
                        <h3 class="text-lg font-black mb-4 flex items-center uppercase tracking-wider">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Hourly Temperature
                        </h3>
                        <div class="w-full h-48">
                            <canvas id="hourly-chart"></canvas>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Admin Management Sections --}}
            <div class="space-y-8">
                {{-- User Management --}}
                <div class="bg-slate-800/80 rounded-3xl p-8 border border-white/10 backdrop-blur-2xl shadow-2xl">
                    <h2 class="text-xl font-black mb-6 flex items-center uppercase tracking-wider">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        User Management
                    </h2>
                    <div class="overflow-x-auto rounded-2xl">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="bg-white/5 text-indigo-300 uppercase font-black tracking-widest text-[10px]">
                                    <th class="px-6 py-4">Full Name</th>
                                    <th class="px-6 py-4">Role</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach ($users as $user)
                                <tr class="hover:bg-white/5">
                                    <td class="px-6 py-4">
                                        <p class="font-black">{{ $user->full_name ?? $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-black {{ $user->role === 'Admin' ? 'bg-indigo-500/20 text-indigo-300' : 'bg-emerald-500/20 text-emerald-300' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="p-1.5 hover:bg-white/10 rounded-lg text-indigo-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete user?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-1.5 hover:bg-red-500/20 rounded-lg text-red-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- API Output --}}
                <div class="bg-indigo-950/40 rounded-3xl p-8 border border-indigo-500/20 shadow-xl">
                    <h3 class="text-sm font-black text-indigo-300 uppercase tracking-widest mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                        API Consumption: /api/users
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach ($apiUsers as $apiUser)
                        <div class="bg-white/5 border border-white/5 rounded-2xl p-4">
                            <p class="text-white font-black text-sm truncate">{{ $apiUser['full_name'] ?? $apiUser['name'] }}</p>
                            <p class="text-[10px] text-indigo-300 font-bold opacity-60">{{ $apiUser['role'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (isset($weather) && !isset($error))
                const hourlyCtx = document.getElementById('hourly-chart').getContext('2d');
                const hourlyLabels = @json(collect($weather['hourly'])->slice(0, 12)->map(fn($h) => \Carbon\Carbon::createFromTimestamp($h['dt'])->format('g a')));
                const hourlyData = @json(collect($weather['hourly'])->slice(0, 12)->pluck('temp'));

                new Chart(hourlyCtx, {
                    type: 'line',
                    data: {
                        labels: hourlyLabels,
                        datasets: [{
                            label: 'Temp',
                            data: hourlyData,
                            borderColor: '#818cf8',
                            borderWidth: 3,
                            pointRadius: 0,
                            tension: 0.4,
                            fill: true,
                            backgroundColor: 'rgba(129, 140, 248, 0.1)',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { display: false }, ticks: { color: 'rgba(255,255,255,0.5)', font: { size: 10 } } },
                            y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: 'rgba(255,255,255,0.5)', font: { size: 10 } } }
                        }
                    }
                });
            @endif
        });
    </script>
    @endpush
</x-app-layout>
