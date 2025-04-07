<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class VietnamPhoneNumberRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Loại bỏ các ký tự không cần thiết như dấu gạch ngang, dấu chấm
        $value = preg_replace('/[\s\.\-]/', '', $value);

        // Kiểm tra số điện thoại với regex (bắt đầu bằng 0 hoặc +84)
        if (!preg_match('/^(0[2-9][0-9]{8}|(\+84)[2-9][0-9]{8})$/', $value)) {
            $fail('Số điện thoại không hợp lệ.');
        }
    }
}
