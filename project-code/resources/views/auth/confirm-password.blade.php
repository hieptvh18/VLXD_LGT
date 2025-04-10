@extends('clients.layouts.auth')
@section('title', 'Xác nhận mật khẩu')
@push('css')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush
@section('content')

    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mx-auto " style="margin: 150px 0;">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Mật khẩu')" />

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    {{ __('Xác nhận') }}
                </x-primary-button>
            </div>
        </form>
    </div>

@endsection


