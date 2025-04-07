<?php

namespace App\Http\Requests\Admin;

use App\Enums\NewsStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:1000',
            'content' => 'required|string',
            'category_ids' => 'required|array',
            'category_ids.*' => 'required|exists:categories,id',
            'source' => 'nullable|string|max:255',
            'is_featured' => 'required|boolean',
            'status' => ['required', Rule::enum(NewsStatusEnum::class)],
            'featured_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
          'title' => 'Tiêu đề',
          'short_desc' => 'Tóm tắt nội dung',
          'content' => 'Nội dung bài viết',
          'source' => 'Nguồn bài viết',
          'is_featured' => 'Bài viết nổi bật',
          'status' => 'Trạng thái',
          'featured_image' => 'Ảnh đại diện',
        ];
    }
}
