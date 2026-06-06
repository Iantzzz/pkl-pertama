<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-6">
        <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">Welcome Back</h2>
        <p class="text-warm-500 dark:text-warm-400 text-sm mt-1">Sign in to your account</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1.5 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-warm-300 dark:border-warm-700 bg-white dark:bg-warm-800 text-blue-600 shadow-sm focus:ring-blue-500/30">
                <span class="ms-2 text-sm text-warm-500 dark:text-warm-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-blue-gradient text-white font-semibold text-sm rounded-xl shadow-blue-sm hover:shadow-blue hover:scale-[1.01] active:scale-[0.99] transition-all duration-200">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
