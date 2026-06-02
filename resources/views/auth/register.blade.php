<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">Create Account</h2>
        <p class="text-warm-500 dark:text-gold-300/60 text-sm mt-1">Join our platform</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-warm-700 dark:text-gold-300" />
            <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-warm-700 dark:text-gold-300" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-warm-700 dark:text-gold-300" />
            <x-text-input id="password" class="block mt-1.5 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-warm-700 dark:text-gold-300" />
            <x-text-input id="password_confirmation" class="block mt-1.5 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-gold-gradient text-warm-900 font-semibold text-sm rounded-xl shadow-gold-sm hover:shadow-gold hover:scale-[1.01] active:scale-[0.99] transition-all duration-200">
                {{ __('Register') }}
            </button>
        </div>
    </form>

    <div class="text-center mt-6 pt-5 border-t border-warm-200 dark:border-gold-500/10">
        <p class="text-sm text-warm-500 dark:text-gold-300/50">
            {{ __('Already registered?') }}
            <a href="{{ route('login') }}" class="text-gold-600 dark:text-gold-300 hover:text-gold-500 font-medium transition-colors">Log in</a>
        </p>
    </div>
</x-guest-layout>
