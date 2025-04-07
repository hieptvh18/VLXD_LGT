@extends('admin.layouts.index')

@section('title', 'Tạo mới liên hệ')
@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Thêm mới liên hệ</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Contact</a>
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
                            <div class="row">
                                <div class="col s12" id="account">
                                    <form id="accountForm"
                                          action="{{ route('admin.contact.store') }}"
                                          method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        <input id="name" name="name" type="text" class="validate"
                                                               value="{{ old('name') }}"
                                                               data-error=".errorTxt1" required>
                                                        <label for="name">Họ tên</label>
                                                        @error('name')
                                                            <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        <input id="phone" name="phone" type="text" class="validate"
                                                               value="{{ old('phone') }}"
                                                               data-error=".errorTxt3" required>
                                                        <label for="phone">Số điện thoại</label>
                                                        @error('phone')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 input-field">
                                                <textarea required name="content" id="content" class="materialize-textarea" cols="30" rows="10">{{ old('content') }}</textarea>
                                                <label for="name">Nội dung</label>
                                                @error('content')
                                                <small class="red-text mt-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col s12 display-flex justify-content-end mt-3">
                                                <button type="submit" class="btn indigo">
                                                    Lưu thay đổi
                                                </button>
                                                <a href="{{ route('admin.contact.index') }}" class="btn btn-light">Hủy</a>
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
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
