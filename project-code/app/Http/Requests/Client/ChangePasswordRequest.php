<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:8'],
            'confirm_password' => ['required', 'same:new_password'],
        ];
    }

    public function attributes(): array
    {
        return [
          'current_password' => 'Mật khẩu hiện tại',
          'new_password' => 'Mật khẩu mới',
          'confirm_password' => 'Mật khẩu xác nhận',
        ];
    }
}
