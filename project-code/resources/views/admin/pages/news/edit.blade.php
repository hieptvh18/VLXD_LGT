@extends('admin.layouts.index')

@section('title', 'Cập nhật tin tức')
@section('content')
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Cập nhật tin tức</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">News</a>
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
                            <div class="row">
                                <div class="col s12" id="account">
                                    <form id="accountForm" action="{{ route('admin.news.update', ['news' => $news->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

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
                                                               class="validate" value="{{ $news->title }}"
                                                               data-error=".errorTxt1">
                                                        <label for="title">Tiêu đề bài viết</label>
                                                        @error('title')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col s12 input-field">
                                                        <input id="source" name="source" type="text"
                                                               class="validate" value="{{ $news->source }}"
                                                               data-error=".errorTxt1">
                                                        <label for="source">Nguồn bài viết</label>
                                                        @error('source')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col s12 input-field">
                                                        <div class="mb-3">
                                                            <label class="mr-3">
                                                                <input type="checkbox" value="1" class="filled-in" name="is_featured" {{ $news->is_featured == 1 ? 'checked' : '' }} />
                                                                <span>Tin nổi bật</span>
                                                            </label>

                                                            <label>
                                                                <input type="checkbox" value="1" class="filled-in" name="is_first_page" {{ $news->is_first_page == 1 ? 'checked' : '' }} />
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
                                                                    {{ in_array($c->id, $news->categories?->pluck('id')?->toArray()) ? 'selected' : '' }}
                                                                    value="{{ $c->id }}">{{ $c->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_ids')
                                                        <small class="red-text mt-2">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col s12 input-field">
                                                        <select name="status">
                                                            <option value="PUBLISH" {{ $news->status == 'PUBLISH' ? 'selected' : '' }}>Đăng bài</option>
                                                            <option value="DRAFT" {{ $news->status == 'DRAFT' ? 'selected' : '' }}>Bản nháp</option>
                                                        </select>
                                                        <label>Trạng thái</label>
                                                    </div>
                                                    <div class="col s12 pt-2 display-flex">
                                                        <div>
                                                            <div class="mb-1">Upload ảnh đại diện (.jpg, .png, .jpeg) *</div>
                                                            <input type="file" id="featured_image_input" name="featured_image">
                                                            @error('featured_image')
                                                            <small class="red-text mt-2">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="preview-imgs mt-1">
                                                            <input type="hidden" name="featured_image" value="{{ $news->id }}">
                                                            <div class="image-container">
                                                                <img class="materialboxed {{ $news->getFirstMediaUrl('featured_image') ? 'display-block' : 'display-none' }}" id="featured_preview" src="{{ $news->getFirstMediaUrl('featured_image') }}" alt="Featured Image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 input-field">
                                                <textarea name="short_desc" id="short_desc" class="materialize-textarea" cols="30" rows="10">{{ $news->short_desc }}</textarea>
                                                <label for="short_desc">Nội dung ngắn</label>
                                            </div>
                                            <div class="row">
                                                <div class="col s12">
                                                    <h4 class="card-title">Nội dung bài viết</h4>
                                                    <div class="row">
                                                        <div class="col s12">
                                                            <div id="full-wrapper">
                                                                <div id="full-container">
                                                                    <textarea name="content" id="editor-desc-bds" required>{{ $news->content }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('content')
                                                    <small class="red-text mt-2">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col s6 input-field">
                                                    <input type="text" disabled value="{{ $news->creator?->name }}">
                                                    <label>Người tạo</label>
                                                </div>
                                                <div class="col s6 input-field">
                                                    <input type="text" disabled value="{{ $news->updater?->name }}">
                                                    <label>Người cập nhật</label>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col s6 input-field">
                                                    <input type="text" disabled value="{{ $news->created_at ? \Carbon\Carbon::parse($news->created_at)->format('d-m-Y H:i:s') : '' }}">
                                                    <label>Ngày tạo</label>
                                                </div>
                                                <div class="col s6 input-field">
                                                    <input type="text" disabled value="{{ $news->updated_at ? \Carbon\Carbon::parse($news->updated_at)->format('d-m-Y H:i:s') : '' }}">
                                                    <label>Ngày cập nhật</label>
                                                </div>
                                            </div>
                                            <div class="col s12 display-flex justify-content-end mt-3">
                                                <button type="submit" class="btn indigo">
                                                    Lưu thay đổi
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
