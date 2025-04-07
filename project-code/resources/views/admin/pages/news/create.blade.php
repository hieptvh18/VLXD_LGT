@extends('admin.layouts.index')

@section('title', 'Tạo mới tin tức')
@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Thêm mới Tin tức</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">News</a>
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
                                    <form id="accountForm" action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        <input id="title" required name="title" type="text"
                                                               class="validate" value="{{ old('title') }}"
                                                               data-error=".errorTxt1">
                                                        <label for="title">Tiêu đề bài viết</label>
                                                        @error('title')
                                                            <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col s12 input-field">
                                                        <input id="source" name="source" type="text"
                                                               class="validate" value="{{ old('source') }}"
                                                               data-error=".errorTxt1">
                                                        <label for="source">Nguồn bài viết</label>
                                                        @error('source')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col s12 input-field">
                                                        <div class="mb-3">
                                                            <label class="mr-3">
                                                                <input type="checkbox" value="1" class="filled-in" name="is_featured" {{ old("is_featured") === 1 ? 'checked' : '' }} />
                                                                <span>Tin nổi bật</span>
                                                            </label>
                                                            <label>
                                                                <input type="checkbox" value="1" class="filled-in" name="is_first_page" {{ old('is_first_page') === 1 ? 'checked' : '' }} />
                                                                <span>Tin trang nhất</span>
                                                            </label>
                                                        </div>
                                                        @error('is_featured')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m6">
                                                <div class="row">
                                                    <div class="col s12 input-field">
                                                        <select class="select2 browser-default" multiple="multiple" id="category_ids" name="category_ids[]" data-placeholder="Danh mục tin tức" required>
                                                            @foreach($categories as $c)
                                                                <option
                                                                    {{ old('category_ids') && in_array($c->id, old('category_ids')) ? 'checked' : '' }}
                                                                    value="{{ $c->id }}">{{ $c->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_ids')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <select name="status">
                                                            <option value="PUBLISH" {{ old('status') == 'PUBLISH' ? 'selected' : '' }}>Đăng bài</option>
                                                            <option value="DRAFT" {{ old('status') == 'DRAFT' ? 'selected' : '' }}>Bản nháp</option>
                                                        </select>
                                                        <label>Trạng thái</label>
                                                    </div>
                                                    <div class="col s12 pt-2 display-flex">
                                                        <div>
                                                            <div class="mb-1">Upload ảnh đại diện (.jpg, .png, .jpeg) *</div>
                                                            <input type="file" id="featured_image_input" name="featured_image" required>
                                                            @error('featured_image')
                                                            <small class="red-text mt-2">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="preview-imgs mt-1">
                                                            <div class="image-container">
                                                                <img class="materialboxed display-none" id="featured_preview" src="" alt="Featured Image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 input-field">
                                                <textarea name="short_desc" id="short_desc" class="materialize-textarea" cols="30" rows="10">{{ old('short_desc') }}</textarea>
                                                <label for="short_desc">Nội dung ngắn</label>
                                            </div>
                                            <div class="row">
                                                <div class="col s12">
                                                    <h4 class="card-title">Nội dung bài viết</h4>
                                                    <div class="row">
                                                        <div class="col s12">
                                                            <div id="full-wrapper">
                                                                <div id="full-container">
                                                                    <textarea name="content" id="editor-desc-bds" required>{{ old('content') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('content')
                                                    <small class="red-text mt-2">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col s12 display-flex justify-content-end mt-3">
                                                <button type="submit" class="btn indigo">
                                                    Lưu
                                                </button>
                                                <a href="{{ route('admin.news.index') }}" class="btn btn-light">Hủy</a>
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
@push('js')
    <script>
        CKEDITOR.replace('editor-desc-bds');
    </script>

    <script src="{{ asset('assets/js/utils.js') }}"></script>

    <script>
        $(document).ready(function () {
            function validateFile(file) {
                const allowedExtensions = ["image/jpeg", "image/png", "image/jpg"];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (!allowedExtensions.includes(file.type)) {
                    return "Chỉ được upload file JPG, PNG, JPEG.";
                }
                if (file.size > maxSize) {
                    return "Dung lượng file không được vượt quá 2MB.";
                }
                return null; // Hợp lệ
            }

            // Validate ảnh đại diện (featured_image)
            $("#featured_image_input").change(function (event) {
                let file = event.target.files[0];
                if (file) {
                    let errorMessage = validateFile(file);
                    if (errorMessage) {
                        alert(errorMessage);
                        $(this).val(""); // Reset input
                        return;
                    }

                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $('#featured_preview').show();
                        $("#featured_preview").attr("src", e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.materialboxed').materialbox();
        });
    </script>
@endpush
