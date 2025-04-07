<?php

namespace App\Http\Requests;

use App\Rules\VietnamPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class SaveContactRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'phone' => ['required', new VietnamPhoneNumberRule()],
            'content' => 'required|string|max:500',
        ];
    }

    public function attributes(): array
    {
        return [
          'name' => 'Tên liên hệ',
          'phone' => 'Số điện thoại',
          'content' => 'Nội dung',
        ];
    }
}
