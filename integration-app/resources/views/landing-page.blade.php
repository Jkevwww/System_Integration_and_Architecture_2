<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIA Integration - Weather & User Management</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-950 text-white selection:bg-indigo-500 selection:text-white">
    <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">
        {{-- Background Effects --}}
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-20" alt="Mountain background">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/40 to-slate-950"></div>
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-600/20 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-600/20 blur-[120px] rounded-full"></div>
        </div>

        {{-- Navigation --}}
        <nav class="absolute top-0 w-full z-20 p-6 sm:p-10 flex justify-between items-center max-w-7xl mx-auto">
            <div class="flex items-center gap-2 group cursor-default">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                    </svg>
                </div>
                <span class="text-xl font-black tracking-tighter uppercase">MINI WEATHER APP</span>
            </div>

            <div class="flex items-center gap-4 sm:gap-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold hover:text-indigo-400 transition-colors">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white/10 hover:bg-white/20 px-5 py-2.5 rounded-xl text-sm font-bold backdrop-blur-md transition-all">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold hover:text-indigo-400 transition-colors">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-2.5 rounded-xl text-sm font-black shadow-lg shadow-indigo-500/20 transition-all active:scale-95">
                            Get Started
                        </a>
                    @endif
                @endauth
            </div>
        </nav>

        {{-- Hero Content --}}
        <main class="relative z-10 max-w-5xl mx-auto px-6 text-center pt-20">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full text-indigo-300 text-xs font-bold uppercase tracking-widest mb-8 animate-fade-in">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                System v2.0 Live
            </div>
            
            <h1 class="text-5xl sm:text-7xl font-black tracking-tighter leading-[1.1] mb-8">
                The Next Generation of <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-blue-400 italic">System Integration</span>
            </h1>

            <p class="text-lg sm:text-xl text-slate-400 font-medium max-w-2xl mx-auto mb-12 leading-relaxed">
                A high-performance Laravel application featuring real-time OpenWeather insights, 
                secure authentication, and a robust internal REST API. Built for modern scalability.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @guest
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-xl shadow-indigo-500/20 transition-all hover:-translate-y-1 active:scale-95 text-lg">
                        Create Free Account
                    </a>
                @endguest
                <div class="flex items-center gap-2 text-slate-400 font-semibold px-6 py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Fast & Secure Integration
                </div>
            </div>

            {{-- Feature Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-24 text-left">
                <div class="p-8 bg-white/5 border border-white/10 rounded-3xl backdrop-blur-md hover:border-indigo-500/50 transition-colors">
                    <div class="w-12 h-12 bg-indigo-600/20 rounded-xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Breeze Auth</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Secure registration with extended fields like Full Name and Role-based access control.</p>
                </div>

                <div class="p-8 bg-white/5 border border-white/10 rounded-3xl backdrop-blur-md hover:border-indigo-500/50 transition-colors">
                    <div class="w-12 h-12 bg-blue-600/20 rounded-xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Internal REST API</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">A specialized API endpoint for user data, consumed directly by our system for seamless integration.</p>
                </div>

                <div class="p-8 bg-white/5 border border-white/10 rounded-3xl backdrop-blur-md hover:border-indigo-500/50 transition-colors">
                    <div class="w-12 h-12 bg-emerald-600/20 rounded-xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">OpenWeather</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Live atmospheric data processing with 5-day forecasts, hourly graphs, and unit toggling.</p>
                </div>
            </div>
        </main>

        <footer class="relative z-10 w-full p-10 mt-20 border-t border-white/5 text-center text-slate-500 text-xs font-bold uppercase tracking-[0.2em]">
            © {{ date('Y') }} SIA System Integration. All rights reserved.
        </footer>
    </div>
</body>
</html>
