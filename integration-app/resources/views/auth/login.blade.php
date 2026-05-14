<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-black text-white tracking-tight">Welcome Back</h2>
        <p class="text-indigo-300 font-medium">Please sign in to your account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-indigo-100 font-bold mb-2" />
            <x-text-input id="email" class="block w-full bg-white/10 border-white/20 text-white focus:ring-indigo-500 focus:border-indigo-500 rounded-xl py-3" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-indigo-100 font-bold mb-2" />
            <x-text-input id="password" class="block w-full bg-white/10 border-white/20 text-white focus:ring-indigo-500 focus:border-indigo-500 rounded-xl py-3"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-white/10 border-white/20 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-indigo-200">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-400 hover:text-indigo-300 font-medium transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl shadow-lg shadow-indigo-500/30 transition-all active:scale-[0.98]">
                {{ __('Sign In') }}
            </x-primary-button>
        </div>

        <div class="text-center text-sm text-indigo-200">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-white font-bold hover:underline ml-1">Register now</a>
        </div>
    </form>
</x-guest-layout>
