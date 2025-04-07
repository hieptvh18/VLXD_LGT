@extends('admin.layouts.index')

@section('title', 'Admin - Danh sách tin tức')
@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Danh sách Tin tức</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">News</a>
                            </li>
                            <li class="breadcrumb-item active">List
                            </li>
                        </ol>
                    </div>
                    <div class="col s2 m6 l6">
                        <a class="btn waves-effect waves-light breadcrumbs-btn right"
                           href="{{ route('admin.news.create') }}">
                            <i class="material-icons hide-on-med-and-up">settings</i>
                            <span class="hide-on-small-onl">Thêm mới</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <!-- newss list start -->
                <section class="users-list-wrapper section">
                    <div class="users-list-filter">
                        <div class="card-panel">
                            <div class="row">
                                <form style="display: flex">
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-type">Danh mục tin</label>
                                        <div class="input-field">
                                            <select class="form-control" id="users-list-type" name="category_id">
                                                <option value="">Tất cả</option>
                                                @foreach($categories as $c)
                                                    <option value="{{ $c->id }}"
                                                        {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-status">Trạng thái</label>
                                        <div class="input-field">
                                            <select class="form-control" id="users-list-status" name="status">
                                                <option value="">All</option>
                                                <option value="DRAFT"
                                                    {{ request('status') == 'DRAFT' ? 'selected' : '' }}>Bản nháp
                                                </option>
                                                <option value="PUBLISH"
                                                    {{ request('status') == 'PUBLISH' ? 'selected' : '' }}>Đăng tải
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col s6 m2 l2 display-flex justify-content-between align-items-center">
                                        <div class="input-field" style="width: 100%; margin-top: 0 !important;">
                                            <label>
                                                <input type="checkbox" value="1" class="filled-in" name="is_featured"
                                                    {{ request('is_featured') == 1 ? 'checked' : '' }} />
                                                <span>Tin nổi bật</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col s6 m2 l2 display-flex justify-content-between align-items-center">
                                        <div class="input-field" style="width: 100%; margin-top: 0 !important;">
                                            <label>
                                                <input type="checkbox" value="1" class="filled-in" name="is_first_page"
                                                    {{ request('is_first_page') == 1 ? 'checked' : '' }} />
                                                <span>Tin trang nhất</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3">
                                        <label for="users-list-status">Tìm kiếm</label>
                                        <div class="input-field">
                                            <input class="form-control" id="users-list-keyword"
                                                   value="{{ request('keyword') }}" name="keyword"
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
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                                <!-- datatable start -->
                                <div class="responsive-table">
                                    <table id="users-list-datatable" class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tiêu đề</th>
                                            <th>Ảnh</th>
                                            <th>Danh mục tin</th>
                                            <th>Tin nổi bật</th>
                                            <th>Tin trang nhất</th>
                                            <th>Nội dung ngắn</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Chi tiết</th>
                                            <th>Xóa</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($news as $key => $new)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td title="{{ $new->title }}">{{ formatSubStr($new->title, 50) }}</td>
                                                <td>
                                                    <div>
                                                        <img src="{{ $new->getFirstMediaUrl('featured_image') }}"
                                                             alt="Featured Image" class="materialboxed"
                                                             style="width: 150px; height: 130px;">
                                                    </div>
                                                </td>
                                                <td>
                                                    @foreach($new->categories as $c)
                                                        <span class="chip">
                                                                <span style="text-wrap: nowrap">
                                                                    {{ $c->name }}
                                                                </span>
                                                            </span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span
                                                        class="chip {{ $new->is_featured ? 'green' : 'red' }} lighten-5">
                                                        @if ($new->is_featured)
                                                            <span class="green-text">Yes</span>
                                                        @else
                                                            <span class="red-text">No</span>
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="chip {{ $new->is_first_page ? 'green' : 'red' }} lighten-5">
                                                        @if ($new->is_first_page)
                                                            <span class="green-text">Yes</span>
                                                        @else
                                                            <span class="red-text">No</span>
                                                        @endif
                                                    </span>
                                                </td>
                                                <td title="{{ $new->short_desc }}">{{ formatSubStr($new->short_desc, 100) }}</td>
                                                <td>
                                                <span
                                                    class="chip {{ $new->status == \App\Enums\NewsStatusEnum::DRAFT ? 'gray' : 'green' }} lighten-5">
                                                    @if($new->status == \App\Enums\NewsStatusEnum::DRAFT)
                                                        <span class="red-text" style="text-wrap: nowrap">Bản nháp</span>
                                                    @else
                                                        <span class="green-text" style="text-wrap: nowrap">Đã đăng</span>
                                                    @endif
                                                </span>
                                                </td>
                                                <td style="text-wrap: nowrap">
                                                    {{ $new->created_at ? \Carbon\Carbon::parse($new->created_at)->format('d-m-Y') : '' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.news.edit', ['news' => $new->id]) }}"><i
                                                            class="material-icons">edit</i></a></td>
                                                <td>
                                                    <form method="POST"
                                                          action="{{ route('admin.news.destroy', ['news' => $new->id]) }}">
                                                        @method('delete')
                                                        @csrf

                                                        <button type="submit" class="waves-effect btn-flat"
                                                                onclick="return confirm('Bạn chắc chắn muốn xóa!')"
                                                        >
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- datatable ends -->
                                <div class="display-flex justify-content-between align-items-center">
                                    <div class="">
                                        Showing {{ $news->firstItem() }} to {{ $news->lastItem() }} of {{ $news->total() }} entries
                                    </div>
                                    <div class="">
                                        {{ $news->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
@push('js')
    {{--    view image --}}
    <script>
        $(document).ready(function () {
            $('.materialboxed').materialbox();
        });
    </script>
@endpush
