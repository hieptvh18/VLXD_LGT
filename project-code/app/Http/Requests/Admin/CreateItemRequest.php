<?php

namespace App\Http\Requests\Admin;

use App\Enums\HomeDirectionEnum;
use App\Enums\ItemStatusEnum;
use App\Enums\ItemTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateItemRequest extends FormRequest
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
            'item_name' => 'required|string|max:255',
            'category_ids' => 'required|array',
            'category_ids.*' => 'required|exists:categories,id',
            'status' => ['required', Rule::enum(ItemStatusEnum::class)],
            'ward_id' => 'required|exists:ward,wardid',
            'address' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string|max:1000',
            'description' => 'nullable|string|max:30000',
            'iframe_maps' => 'nullable|string|max:1000',
            'is_featured' => 'nullable|in:0,1',
            'type' => ['nullable', Rule::enum(ItemTypeEnum::class)],
            'area' => 'required|integer|min:1|max:99999999999',
            'width' => 'required|integer|min:1|max:99999999999',
            'height' => 'required|integer|min:1|max:99999999999',
            'total_bedrooms' => 'required|integer|min:1|max:99999999999',
            'total_bathrooms' => 'required|integer|min:1|max:99999999999',
            'total_floors' => 'required|integer|min:1|max:99999999999',
            'price' => 'required|numeric|min:1000000|digits_between:1,65|regex:/^\d{1,65}$/',
            'home_direction' => ['required', Rule::enum(HomeDirectionEnum::class)],
            'price_text' => 'nullable|string|max:255'
        ];
    }

    public function attributes()
    {
        return [
            'item_name' => 'BDS',
            'type' => 'Loại BDS',
            'ward_id' => 'Phường xã',
            'address' => 'Địa chỉ',
            'short_desc' => 'Giới thiệu ngắn',
            'description' => 'Mô tả',
            'iframe_maps' => 'Nhúng google maps',
            'is_featured' => 'Nổi bật',
            'status' => 'Trạng thái',
            'area' => 'Diện tích',
            'width' => 'Chiều rộng',
            'height' => 'Chiều dài',
            'total_bedrooms' => 'Số phòng ngủ',
            'total_bathrooms' => 'Số nhà tắm',
            'total_floors' => 'Số tầng',
            'price' => 'Giá(Bằng số)',
            'home_direction' => 'Hướng nhà',
            'price_text' => 'Giá(Bằng chữ)',
            'category_ids' => 'Loại BDS'
        ];
    }

    public function messages()
    {
        return [
          'price.min' => 'Giá tối thiểu phải là 1,000,000 (1 triệu đồng)'
        ];
    }
}
