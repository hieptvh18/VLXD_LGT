<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait AutoGenerateItemCode
{
    public static function bootAutoGenerateItemCode()
    {
        static::creating(function ($item) {
            // Gán tạm thời item_code để tránh lỗi nếu có validation yêu cầu
            $item->item_code = 'TEMP';
        });

        static::created(function ($item) {
            // Tạo mã item_code theo định dạng BDS_00001
            $item->item_code = 'BDS_' . str_pad($item->id, 3, '0', STR_PAD_LEFT);

            // Cập nhật lại item_code mà không gây sự kiện observer
            $item->saveQuietly();
        });
    }
}
