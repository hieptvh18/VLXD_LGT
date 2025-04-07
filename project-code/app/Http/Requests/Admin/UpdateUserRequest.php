<?php

namespace App\Http\Requests\Admin;

use App\Enums\RoleEnum;
use App\Rules\VietnamPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . request()->user],
            'phone' => ['required', new VietnamPhoneNumberRule(), 'unique:users,phone,' . request()->user],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', Rule::enum(RoleEnum::class)],
            'is_active' => ['required', 'in:0,1'],
        ];
    }
}
