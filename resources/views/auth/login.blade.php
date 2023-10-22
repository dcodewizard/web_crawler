<x-guest-layout>
    <x-auth-card>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <div class="container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-outline mb-4">
                    <x-label class="form-label" for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autofocus />
                </div>
                <div class="form-outline mt-4">
                    <x-label class="form-label" for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full form-control"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                </div>
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>
                <x-button class="btn btn-primary btn-block mb-4">
                        {{ __('Log in') }}
                </x-button>
            </form>
            <div class="col d-flex justify-content-center">
                <span class="ml-2 text-sm text-gray-600">Don't have an account? <a href="{{ route('register') }}">Register here</a></span>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
