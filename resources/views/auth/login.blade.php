<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mb-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingatkan saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mb-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-end mb-4">
            <x-primary-button class="ms-3 bg-green-600 hover:bg-green-700">
                <i class="fas fa-sign-in-alt mr-2"></i>{{ __('Masuk') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            <p class="text-gray-600">Belum punya akun? 
                <a href="{{ route('register') }}" class="text-green-500 hover:text-green-600 font-bold">Daftar di sini</a>
            </p>
        </div>
    </form>

    <style>
        .bg-green-600 {
            background-color: #059669;
        }
        .bg-green-600:hover {
            background-color: #047857;
        }
        .text-green-600 {
            color: #059669;
        }
    </style>
</x-guest-layout>
