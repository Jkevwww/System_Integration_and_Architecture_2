<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Philippine Mythology Almanac Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen py-10">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="bg-indigo-900 py-6 px-8">
            <h1 class="text-3xl font-bold text-white">Philippine Mythology Almanac Registration Form</h1>
            <p class="text-indigo-200 mt-2">Help us document and preserve our legendary creatures.</p>
        </div>

        <div class="p-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- General Error Message -->
            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                    <p class="font-bold">There were errors with your submission:</p>
                    <ul class="list-disc list-inside mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('registration.submit') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Full Name -->
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700">Registrar Full Name</label>
                    <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border @error('full_name') border-red-500 @enderror">
                    @error('full_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Creature Name -->
                <div>
                    <label for="creature_name" class="block text-sm font-medium text-gray-700">Mythological Creature Name</label>
                    <input type="text" name="creature_name" id="creature_name" value="{{ old('creature_name') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border @error('creature_name') border-red-500 @enderror">
                    @error('creature_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Creature Type -->
                <div>
                    <label for="creature_type" class="block text-sm font-medium text-gray-700">Creature Classification</label>
                    <select name="creature_type" id="creature_type" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border @error('creature_type') border-red-500 @enderror">
                        <option value="">-- Select Classification --</option>
                        <option value="vampiric" {{ old('creature_type') == 'vampiric' ? 'selected' : '' }}>Vampiric / Bloodsucker</option>
                        <option value="shapeshifter" {{ old('creature_type') == 'shapeshifter' ? 'selected' : '' }}>Shapeshifter</option>
                        <option value="elemental" {{ old('creature_type') == 'elemental' ? 'selected' : '' }}>Nature Elemental</option>
                        <option value="giant" {{ old('creature_type') == 'giant' ? 'selected' : '' }}>Giant</option>
                        <option value="diwata" {{ old('creature_type') == 'diwata' ? 'selected' : '' }}>Diwata / Goddess</option>
                        <option value="duwende" {{ old('creature_type') == 'duwende' ? 'selected' : '' }}>Dwarf / Goblin</option>
                    </select>
                    @error('creature_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Full Description and Attributes</label>
                    <textarea name="description" id="description" rows="4" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Agreement -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input name="agreement" id="agreement" type="checkbox" value="1" {{ old('agreement') ? 'checked' : '' }}
                               class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded @error('agreement') border-red-500 @enderror">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="agreement" class="font-medium text-gray-700">I verify that the information above is accurate and based on local legends.</label>
                        @error('agreement')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-md hover:bg-indigo-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Submit Registration to Almanac
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center mt-6 text-gray-500 text-sm">
        &copy; {{ date('Y') }} Philippine Mythology Almanac Registration System
    </div>
</body>
</html>
