<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-black text-white tracking-tight">Create Account</h2>
        <p class="text-indigo-300 font-medium">Join us for your personalized weather experience</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Username -->
            <div>
                <x-input-label for="name" :value="__('Username')" class="text-indigo-100 font-bold mb-1.5" />
                <x-text-input id="name" class="block w-full bg-white/10 border-white/20 text-white rounded-xl py-2.5" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Full Name -->
            <div>
                <x-input-label for="full_name" :value="__('Full Name')" class="text-indigo-100 font-bold mb-1.5" />
                <x-text-input id="full_name" class="block w-full bg-white/10 border-white/20 text-white rounded-xl py-2.5" type="text" name="full_name" :value="old('full_name')" required autocomplete="name" placeholder="" />
                <x-input-error :messages="$errors->get('full_name')" class="mt-1" />
            </div>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-indigo-100 font-bold mb-1.5" />
            <x-text-input id="email" class="block w-full bg-white/10 border-white/20 text-white rounded-xl py-2.5" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Role -->
        <div>
            <x-input-label for="role" :value="__('Account Role')" class="text-indigo-100 font-bold mb-1.5" />
            <select id="role" name="role" class="block w-full bg-white/10 border-white/20 text-white focus:ring-indigo-500 focus:border-indigo-500 rounded-xl py-2.5 backdrop-blur-md">
                <option value="User" class="bg-slate-800 text-white">User</option>
                <option value="Admin" class="bg-slate-800 text-white">Admin</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-1" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-indigo-100 font-bold mb-1.5" />
                <x-text-input id="password" class="block w-full bg-white/10 border-white/20 text-white rounded-xl py-2.5"
                                type="password"
                                name="password"
                                required autocomplete="new-password" placeholder="" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm')" class="text-indigo-100 font-bold mb-1.5" />
                <x-text-input id="password_confirmation" class="block w-full bg-white/10 border-white/20 text-white rounded-xl py-2.5"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl shadow-lg shadow-indigo-500/30 transition-all active:scale-[0.98]">
                {{ __('Complete Registration') }}
            </x-primary-button>
        </div>

        <div class="text-center text-sm text-indigo-200 mt-4">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-white font-bold hover:underline ml-1">Sign In</a>
        </div>
    </form>
</x-guest-layout>
