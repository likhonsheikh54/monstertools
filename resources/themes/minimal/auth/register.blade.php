<x-canvas-guest-layout>
    <x-auth-card>
        <x-slot name="text">
            <h1>@lang('auth.already_registered')</h1>
            <p>@lang('auth.signInToYourAccount')</p>
            <a class="btn btn-secondary" href="{{ route('login') }}">
                {{ __('auth.login') }}
            </a>
        </x-slot>
        <div class="navbar-brand mb-3">
            <a href="{{ route('front.index') }}">
                <x-application-logo />
            </a>
        </div>
        <x-application-social-auth />
        <p>{{ __('auth.useEmail') }}</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <x-text-input id="name" type="text" name="name" :value="$data['name']"
                    placeholder="{{ __('auth.name') }}" :error="$errors->has('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" />
            </div>
            <div class="mt-3">
                <x-text-input id="username" type="text" name="username" placeholder="{{ __('auth.username') }}"
                    :value="$data['username']" :error="$errors->has('username')" autocomplete="off" required />
                <x-input-error :messages="$errors->get('username')" />
            </div>
            <div class="mt-3">
                <x-text-input id="email" type="email" name="email" placeholder="{{ __('auth.email') }}"
                    :value="old('email')" :error="$errors->has('email')" autocomplete="username" required />
                <x-input-error :messages="$errors->get('email')" />
            </div>
            <div class="mt-3">
                <x-text-input id="password" type="password" name="password" placeholder="{{ __('auth.password') }}"
                    required :error="$errors->has('password')" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>
            <div class="mt-3">
                <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                    placeholder="{{ __('auth.confirmPassword') }}" :error="$errors->has('password_confirmation')" required />
                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>
            <div class="d-grid gap-2 mt-3">
                <x-primary-button class="ml-4">
                    {{ __('auth.register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-canvas-guest-layout>
