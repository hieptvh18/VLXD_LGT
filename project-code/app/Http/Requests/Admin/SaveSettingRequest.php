<?php

namespace App\Http\Requests\Admin;

use App\Rules\VietnamPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class SaveSettingRequest extends FormRequest
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
        $logoRule = request()->file('web_logo') ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'required|string|max:255';
        $faviconRule = request()->file('web_favicon') ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'required|string|max:255';

        return [
            'web_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => ['nullable', new VietnamPhoneNumberRule()],
            'address' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string|max:10000',
            'description' => 'nullable|string|max:30000',
            'web_logo' => $logoRule,
            'web_favicon' => $faviconRule,
        ];
    }

    public function attributes(): array
    {
        return [
            'web_name' => 'Tên website',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'short_desc' => 'Mô tả ngắn',
            'description' => 'Mô tả',
            'web_logo' => 'Logo',
            'web_favicon' => 'Favicon',
        ];
    }
}
