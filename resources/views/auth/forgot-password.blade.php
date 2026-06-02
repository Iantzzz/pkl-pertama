<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">Reset Password</h2>
    </div>

    <div class="mb-4 text-sm text-warm-600 dark:text-gold-300/70">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-warm-700 dark:text-gold-300" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center">
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
