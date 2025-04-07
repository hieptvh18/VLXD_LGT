@extends('admin.layouts.index')

@section('title', 'Admin - Quản lý danh mục')
@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Quản lý danh mục dự án / Bất động sản </span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <!-- users list start -->
                <section class="users-list-wrapper section">
                    <div class="users-list-filter">
                        <div class="card-panel">
                            <div class="row">
                                <form style="display: flex">
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-status">Loại</label>
                                        <div class="input-field">
                                            <select class="form-control" id="users-list-status" name="type">
                                                <option value="">All</option>
                                                @foreach(\App\Helpers\Constant::CATE_TYPE_TEXT as $val => $key)
                                                    <option value="{{ $val }}" {{ request('type') == 1 ? 'selected' : '' }}>{{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-status">Trạng thái</label>
                                        <div class="input-field">
                                            <select class="form-control" id="users-list-status" name="is_active">
                                                <option value="">All</option>
                                                <option value="1" {{ request('is_active') == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ (request()->has('is_active') && request('is_active') === '0') ? 'selected' : '' }}>DeActive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-status">Tìm kiếm</label>
                                        <div class="input-field">
                                            <input class="form-control" id="users-list-keyword" name="keyword"
                                                   placeholder="Nhập text..."/>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3 display-flex align-items-center show-btn">
                                        <button type="submit" class="btn btn-block indigo waves-effect waves-light">Tìm
                                            kiếm
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="users-list-table display-flex">
                        <div class="card col s4">
                            <div class="card-content">
                                <form id="categoryForm"
                                      action="{{ request('edit') ? route('admin.category.update', ['category'=>$category->id]) : route('admin.category.store') }}"
                                      method="POST">
                                    @csrf
                                    @if(request('edit'))
                                        @method('PUT')
                                    @endif
                                    <div class="row">
                                        <div class="row">
                                            <div class="col s12 input-field">
                                                <input id="name" name="name" type="text" class="validate"
                                                       value="{{ $category?->name ?? old('name') }}"
                                                       data-error=".errorTxt1" required>
                                                <label for="name">Tên danh mục</label>
                                                @error('name')
                                                <small class="red-text mt-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col s12 input-field">
                                                <input id="intro" name="intro" type="text" class="validate"
                                                       value="{{ $category?->intro ?? old('intro') }}"
                                                       data-error=".errorTxt1">
                                                <label for="intro">Giới thiệu ngắn</label>
                                                @error('intro')
                                                <small class="red-text mt-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col s12 input-field">
                                                <div>
                                                    Loại danh mục
                                                </div>
                                                <select class="form-control" id="users-list-status" name="type">
                                                    @foreach(\App\Helpers\Constant::CATE_TYPE_TEXT as $val => $key)
                                                        <option value="{{ $val }}"
                                                            {{ $category?->type ? ($category?->type == $val ? 'selected' : '') : (request('type') == $val ? 'selected' : '') }}
                                                        >{{ $key }}</option>
                                                    @endforeach
                                                </select>
                                                @error('type')
                                                <small class="red-text mt-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col s12 switch">
                                                <div class="mb-2">Trạng thái</div>
                                                <label>
                                                    Off
                                                    <input type="checkbox" name="is_active" value="1"
                                                           @if($category && $category?->is_active == 1)
                                                               checked
                                                           @elseif($category && !$category?->is_active)
                                                           @else
                                                               checked
                                                           @endif
                                                    >
                                                    <span class="lever"></span>
                                                    On
                                                </label>
                                                @error('is_active')
                                                <small class="red-text mt-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col s12 display-flex justify-content-end mt-3">
                                            <button type="submit" class="btn indigo">
                                                {{ $category ? 'Sửa' : 'Tạo' }}
                                            </button>
                                            <a href="{{ route('admin.category.index') }}" class="btn btn-light">Hủy</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card col s8">
                            <div class="card-content">
                                <!-- datatable start -->
                                <div class="responsive-table">
                                    <table id="users-list-datatable" class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>STT</th>
                                            <th>Tên</th>
                                            <th>Loại</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $key=>$category)
                                            <tr>
                                                <td></td>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <span class="chip">
                                                        <span>{{ \App\Helpers\Constant::CATE_TYPE_TEXT[$category->type] }}</span>
                                                    </span>
                                                </td>
                                                <td>
                                                <span
                                                    class="chip {{ $category->is_active ? 'green' : 'red' }} lighten-5">
                                                    @if($category->is_active)
                                                        <span class="green-text">Hoạt động</span>
                                                    @else
                                                        <span class="red-text">Khóa</span>
                                                    @endif
                                                </span>
                                                </td>
                                                <td>
                                                    <div class="display-flex align-items-center">
                                                        <a href="{{ route('admin.category.index', ['edit' => $category->id]) }}">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <form method="POST"
                                                              action="{{ route('admin.category.destroy', ['category' => $category->id]) }}">
                                                            @method('delete')
                                                            @csrf

                                                            <button type="submit" class="waves-effect btn-flat"
                                                                    onclick="return confirm('Bạn chắc chắn muốn xóa!')"
                                                            >
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- datatable ends -->
                                <div class="display-flex justify-content-between align-items-center">
                                    <div class="">
                                        Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} entries
                                    </div>
                                    <div class="">
                                        {{ $categories->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users list ends --><!-- START RIGHT SIDEBAR NAV -->

                <!-- END RIGHT SIDEBAR NAV -->
                <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a
                        class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i
                            class="material-icons">add</i></a>
                    <ul>
                        <li><a href="css-helpers.html" class="btn-floating blue"><i
                                    class="material-icons">help_outline</i></a></li>
                        <li><a href="cards-extended.html" class="btn-floating green"><i
                                    class="material-icons">widgets</i></a></li>
                        <li><a href="app-calendar.html" class="btn-floating amber"><i
                                    class="material-icons">today</i></a></li>
                        <li><a href="app-email.html" class="btn-floating red"><i class="material-icons">mail_outline</i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
