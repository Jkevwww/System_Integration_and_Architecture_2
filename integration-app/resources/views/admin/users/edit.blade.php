<x-app-layout>
    <div class="relative min-h-screen bg-slate-900 text-white">
        <div class="bg-indigo-900/50 border-b border-indigo-500/30 backdrop-blur-md p-6">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="p-2 hover:bg-white/10 rounded-full text-indigo-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <h1 class="text-3xl font-black tracking-tight">Edit User Account</h1>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto p-6 lg:p-8">
            <div class="bg-slate-800/50 rounded-3xl p-8 border border-white/10 backdrop-blur-xl shadow-2xl">
                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" :value="__('Username')" class="text-indigo-100 font-bold mb-2" />
                            <x-text-input id="name" name="name" type="text" class="block w-full bg-white/10 border-white/20 text-white rounded-xl py-3 focus:ring-indigo-500" :value="old('name', $user->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="full_name" :value="__('Full Name')" class="text-indigo-100 font-bold mb-2" />
                            <x-text-input id="full_name" name="full_name" type="text" class="block w-full bg-white/10 border-white/20 text-white rounded-xl py-3 focus:ring-indigo-500" :value="old('full_name', $user->full_name)" required />
                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email Address')" class="text-indigo-100 font-bold mb-2" />
                        <x-text-input id="email" name="email" type="email" class="block w-full bg-white/10 border-white/20 text-white rounded-xl py-3 focus:ring-indigo-500" :value="old('email', $user->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="role" :value="__('Account Role')" class="text-indigo-100 font-bold mb-2" />
                        <select name="role" id="role" class="block w-full bg-white/10 border-white/20 text-white focus:ring-indigo-500 focus:border-indigo-500 rounded-xl py-3 backdrop-blur-md">
                            <option value="User" {{ old('role', $user->role) === 'User' ? 'selected' : '' }} class="bg-slate-800">User</option>
                            <option value="Admin" {{ old('role', $user->role) === 'Admin' ? 'selected' : '' }} class="bg-slate-800">Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="pt-6 border-t border-white/10 flex justify-end gap-4">
                        <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 bg-white/5 hover:bg-white/10 text-white font-bold rounded-xl transition-all">
                            Cancel
                        </a>
                        <x-primary-button class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-xl shadow-lg shadow-indigo-500/20 transition-all active:scale-95">
                            Update Changes
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
