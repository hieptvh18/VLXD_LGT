<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SaveMediaRequest extends FormRequest
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
            'featured_image' => 'required',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'featured_image' => 'Ảnh đại diện',
            'images' => 'Ảnh chi tiết',
            'images.*' => 'Ảnh chi tiết',
        ];
    }
}
