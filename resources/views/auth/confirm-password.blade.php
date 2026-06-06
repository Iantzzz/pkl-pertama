<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">Confirm Password</h2>
    </div>

    <div class="mb-4 text-sm text-warm-600 dark:text-warm-400">
        {{ __('This is a secure area. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1.5 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
