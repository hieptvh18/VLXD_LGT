<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveFeedbackRequest extends FormRequest
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
            'customer_name' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string|max:1000'
        ];
    }

    public function attributes(): array
    {
        return [
          'title' => 'Tiêu đề',
          'customer_name' => 'Tên khách hàng',
          'rating' => 'Số sao',
          'content' => 'Nội dung',
        ];
    }
}
