@extends('admin.layouts.index')

@section('title', 'Chỉnh sửa Tài khoản')
@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Users edit</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">User</a>
                            </li>
                            <li class="breadcrumb-item active">Edit
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
                                    <!-- users edit media object start -->
                                    {{--                                    <div class="media display-flex align-items-center mb-2">--}}
                                    {{--                                        <a class="mr-2" href="#">--}}
                                    {{--                                            <img src="../../../app-assets/images/avatar/avatar-11.png" alt="users avatar" class="z-depth-4 circle"--}}
                                    {{--                                                 height="64" width="64">--}}
                                    {{--                                        </a>--}}
                                    {{--                                        <div class="media-body">--}}
                                    {{--                                            <h5 class="media-heading mt-0">Avatar</h5>--}}
                                    {{--                                            <div class="user-edit-btns display-flex">--}}
                                    {{--                                                <a href="#" class="btn-small indigo">Change</a>--}}
                                    {{--                                                <a href="#" class="btn-small btn-light-pink">Reset</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <!-- users edit media object ends -->
                                    <!-- users edit account form start -->
                                    <form id="accountForm"
                                          action="{{ route('admin.user.update', ['user' => $user->id]) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        <input id="username" name="name" type="text" class="validate"
                                                               value="{{ $user->name }}"
                                                               data-error=".errorTxt1">
                                                        <label for="username">Họ tên</label>
                                                        @error('name')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <input id="email" name="email" type="email" class="validate"
                                                               value="{{ $user->email }}"
                                                               data-error=".errorTxt3">
                                                        <label for="email">E-mail</label>
                                                        @error('email')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <input id="name" name="phone" type="text" class="validate"
                                                               value="{{ $user->phone }}"
                                                               data-error=".errorTxt2">
                                                        <label for="name">Số điện thoại</label>
                                                        @error('phone')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        @if(isSuperAdmin())
                                                            <input type="hidden" name="role" value="{{ $user->role }}">
                                                        @endif
                                                        <select name="role" {{ isSuperAdmin() ? 'disabled' : '' }}>
                                                            <option value="CUSTOMER" {{ $user->role == \App\Helpers\Constant::USER_CUSTOMER_ROLE ? 'selected' : '' }}>Khách hàng</option>
                                                            <option value="ADMIN" {{ $user->role == \App\Helpers\Constant::USER_ADMIN_ROLE ? 'selected' : '' }}>ADMIN</option>
                                                            <option value="SUPER_ADMIN" {{ $user->role == \App\Helpers\Constant::USER_SUPER_ADMIN_ROLE ? 'selected' : '' }}>SUPER ADMIN</option>
                                                        </select>
                                                        <label>Vai trò</label>
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <select name="is_active">
                                                            <option value="1" {{ $user->is_active == \App\Helpers\Constant::USER_STATUS_ACTIVE ? 'selected' : '' }}>Hoạt động</option>
                                                            <option value="0" {{ $user->is_active == \App\Helpers\Constant::USER_STATUS_DEACTIVE ? 'selected' : '' }}>Khóa</option>
                                                        </select>
                                                        <label>Trạng thái</label>
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
                <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i class="material-icons">add</i></a>
                    <ul>
                        <li><a href="css-helpers.html" class="btn-floating blue"><i class="material-icons">help_outline</i></a></li>
                        <li><a href="cards-extended.html" class="btn-floating green"><i class="material-icons">widgets</i></a></li>
                        <li><a href="app-calendar.html" class="btn-floating amber"><i class="material-icons">today</i></a></li>
                        <li><a href="app-email.html" class="btn-floating red"><i class="material-icons">mail_outline</i></a></li>
                    </ul>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
