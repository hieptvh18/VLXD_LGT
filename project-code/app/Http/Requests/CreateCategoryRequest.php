<?php

namespace App\Http\Requests;

use App\Enums\CategoryTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'required|string|unique:categories,name|max:255',
            'intro' => 'nullable|string|max:255',
            'type' => ['required', Rule::enum(CategoryTypeEnum::class)],
            'is_active' => 'nullable|in:0,1',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên danh mục',
            'intro' => 'Giới thiệu ngắn',
            'is_active' => 'Trạng thái',
            'type' => 'Loại danh mục',
        ];
    }
}
