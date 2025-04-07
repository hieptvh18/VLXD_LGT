@extends('clients.layouts.auth')
@section('title', 'Đăng ký tài khoản')
@push('css')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush
@section('content')

    <div>
        <h3 class="text-xl font-bold text-center mt-5" style="font-weight: bold">Đăng ký tài khoản</h3>
    </div>

    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mx-auto " style="margin: 30px 0 150px 0;">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Họ tên')" />
                <x-text-input placeholder="John" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input placeholder="example@gmail.com" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone number -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Số điện thoại')" />
                <x-text-input placeholder="0989581167" id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mật khẩu')" />

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Xác nhận mật khẩu')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Bạn đã có tài khoản?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Đăng ký') }}
                </x-primary-button>
            </div>
        </form>
    </div>

@endsection

