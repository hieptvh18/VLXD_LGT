@extends('clients.layouts.index')
@section('title', "Tài khoản - " . getWebName())

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endpush
@section('content')
    <!-- content page -->
    <div class="re__main-content container py-5 px-5" id="profile__content-wrapper">
        <!-- breadcrumb -->
        <div class="re__project-breadcrumb">
                <span>
                    <a href="{{ route('client.home') }}" class="re__link-se--previous">
                        <span>Home</span>
                    </a>
                </span>
            <span>/</span>
            <span>
                <a href="#" title="" class="re__link-se--previous">
                    <span>Tài khoản</span>
                </a>
            </span>
        </div>

        <div class="profile__content pt-4">
            <div class="profile-form">
                <h3 class="text-md text-bold">Thay đổi thông tin tài khoản</h3>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Họ tên</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" required>
                        @error('name')
                        <small class="red-text mt-2">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email (Email đăng nhập*)</label>
                        <input type="text" name="email" id="email" value="{{ $user->email }}" required>
                        @error('email')
                        <small class="red-text mt-2">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" value="{{ $user->phone }}" required>
                        @error('phone')
                        <small class="red-text mt-2">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="btn-group">
                        <button class="btn" type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>

            <div class="change-password-form">
                <h3 class="text-md text-bold">Thay đổi mật khẩu</h3>
                <form method="POST" action="{{ route('profile.changePassword') }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="current_password">Mật khẩu hiện tại</label>
                        <input type="password" name="current_password" id="current_password" required>
                        @error('current_password')
                        <small class="red-text mt-2">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password">Mật khẩu mới</label>
                        <input type="password" name="new_password" id="new_password" required>
                        @error('new_password')
                        <small class="red-text mt-2">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Nhập lại mật khẩu mới</label>
                        <input type="password" name="confirm_password" id="confirm_password" required>
                        @error('confirm_password')
                        <small class="red-text mt-2">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="btn-group">
                        <button class="btn" type="submit">Thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end content page -->
@endsection
