@extends('clients.layouts.auth')
@section('title', 'Quên mật khẩu')
@push('css')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush
@section('content')

    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mx-auto " style="margin: 150px 0;">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Bạn quên mật khẩu? Không có gì. Chỉ cần cho chúng tôi biết địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn liên kết đặt lại mật khẩu qua email để cho phép bạn chọn địa chỉ mới.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Nhập email của bạn " :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Reset mật khẩu') }}
                </x-primary-button>
            </div>
        </form>
    </div>

@endsection

