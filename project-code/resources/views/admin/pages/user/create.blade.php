@extends('admin.layouts.index')

@section('title', 'Tạo mới tài khoản')
@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Thêm mới tài khoản</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">User</a>
                            </li>
                            <li class="breadcrumb-item active">Create
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <!-- users edit start -->
                <div class="section users-edit">
                    <div class="card">
                        <div class="card-content">
                            <!-- <div class="card-body"> -->
                            <div class="divider mb-3"></div>
                            <div class="row">
                                <div class="col s12" id="account">
                                    <form id="accountForm"
                                          action="{{ route('admin.user.store') }}"
                                          method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        <input id="username" name="name" type="text" class="validate"
                                                               value="{{ old('name') }}"
                                                               data-error=".errorTxt1">
                                                        <label for="username">Họ tên</label>
                                                        @error('name')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <input id="email" name="email" type="email" class="validate"
                                                               value="{{ old('email') }}"
                                                               data-error=".errorTxt3">
                                                        <label for="email">E-mail</label>
                                                        @error('email')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <input id="name" name="password" type="password" class="validate"
                                                               value="{{ old('password') }}"
                                                               data-error=".errorTxt2">
                                                        <label for="name">Mật khẩu</label>
                                                        @error('password')
                                                            <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        <select name="role">
                                                            <option {{ old('role') == 'CUSTOMER' ? 'selected' : '' }} value="CUSTOMER">Khách hàng</option>
                                                            <option {{ old('role') == 'ADMIN' ? 'selected' : '' }} value="ADMIN">ADMIN</option>
                                                        </select>
                                                        <label>Vai trò</label>
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <select name="is_active">
                                                            <option value="1" {{ old('is_active') == \App\Helpers\Constant::USER_STATUS_ACTIVE }}>Hoạt động</option>
                                                            <option value="0" {{ old('is_active') == \App\Helpers\Constant::USER_STATUS_DEACTIVE }}>Khóa</option>
                                                        </select>
                                                        <label>Trạng thái</label>
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <input id="name" name="phone" type="text" class="validate"
                                                               value="{{ old('phone') }}"
                                                               data-error=".errorTxt2">
                                                        <label for="name">Số điện thoại</label>
                                                        @error('phone')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 display-flex justify-content-end mt-3">
                                                <button type="submit" class="btn indigo">
                                                    Lưu thay đổi
                                                </button>
                                                <a href="{{ route('admin.user.index') }}" class="btn btn-light">Hủy</a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- users edit account form ends -->
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                <!-- users edit ends -->
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
