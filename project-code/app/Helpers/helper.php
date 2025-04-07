<?php

use App\Helpers\Constant;
use App\Models\Category;
use App\Models\News;

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin()
    {
        return auth()->check() ? (
        auth()->user()->role == Constant::USER_SUPER_ADMIN_ROLE ? true : false
        ) : false;
    }
}


if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        return auth()->check() ? (
        auth()->user()->role == Constant::USER_ADMIN_ROLE ? true : false
        ) : false;
    }
}

if (!function_exists('isCustomer')) {
    function isCustomer()
    {
        return auth()->check() ? (
        auth()->user()->role == Constant::USER_CUSTOMER_ROLE ? true : false
        ) : false;
    }
}

if (!function_exists('getLogo')) {
    function getLogo()
    {
        return asset('assets/img/logoLGT.png');
    }
}

if (!function_exists('getFavicon')) {
    function getFavicon()
    {
        $favicon = \App\Models\Setting::first()?->web_favicon;
        return asset('storage/' . $favicon) ?? null;
    }
}

if (!function_exists('getWebName')) {
    function getWebName()
    {
        return 'LGT Joint Stock Company';
    }
}

if (!function_exists('getProvinces')) {
    function getProvinces()
    {
        return \App\Models\Province::all();
    }
}


if (!function_exists('getDistricts')) {
    function getDistricts()
    {
        return \App\Models\District::all();
    }
}

if (!function_exists('getDistrictsByProvince')) {
    function getDistrictsByProvince($province_id, $limit = 10)
    {
        return \App\Models\District::where('provinceid', $province_id)
            ->limit($limit)
            ->orderBy('districtid', 'ASC')
            ->get();
    }
}


if (!function_exists('getWards')) {
    function getWards()
    {
        return \App\Models\Ward::all();
    }
}

// get all categories type BDS
if (!function_exists('getItemCategories')) {
    function getItemCategories()
    {
        return Category::where('type', Constant::CATE_TYPE_ITEM)
            ->where('is_active', true)
            ->get();
    }
}

//get all categories type news
if (!function_exists('getNewsCategories')) {
    function getNewsCategories()
    {
        return Category::where('type', Constant::CATE_TYPE_NEWS)
            ->where('is_active', true)
            ->get();
    }
}

/**
 * Get categories data for aside block
 */
if (!function_exists('getCategoriesSidebar')) {
    function getCategoriesSidebar()
    {
        return Category::select('id', 'name', 'intro')
            ->with(['news'])
            ->where('type', Constant::CATE_TYPE_NEWS)
            ->where('is_active', true)
            ->orderBy('id')
            ->limit(10)
            ->get();
    }
}

/**
 * Get bài viết có thể bạn quan tâm 5 bai random
 */
if (!function_exists('getRandomListNews')) {
    function getRandomListNews($number = 5)
    {
        return News::inRandomOrder()
            ->where('is_first_page', false)
            ->where('is_featured', false)
            ->limit($number)
            ->get();
    }
}

/**
 * Get bài viết có thể bạn quan tâm 5 bai random
 */
if (!function_exists('getRandomListItems')) {
    function getRandomListItems($number = 10)
    {
        return \App\Models\Item::select('id', 'item_name', 'slug')
            ->inRandomOrder()
            ->where('status', '<>', \App\Enums\ItemStatusEnum::DISABLE)
            ->limit($number)
            ->get();
    }
}

/**
 * func format description về dạng có ... nếu đoạn text dài quá số kí tự cho phép
 */
if (!function_exists('formatSubStr')) {
    function formatSubStr($string, $length = 300)
    {
        if (!$string) {
            return '';
        }
        return mb_strlen($string, 'UTF-8') > $length
            ? mb_substr($string, 0, $length, 'UTF-8') . '...'
            : $string;
    }
}

/**
 * func format number to text price VND
 */
if (!function_exists('convertNumberToWords')) {
    function convertNumberToWords($number)
    {
        $units = ['', 'nghìn', 'triệu', 'tỷ', 'nghìn tỷ', 'triệu tỷ', 'tỷ tỷ'];
        $numberWords = [
            0 => 'không', 1 => 'một', 2 => 'hai', 3 => 'ba', 4 => 'bốn',
            5 => 'năm', 6 => 'sáu', 7 => 'bảy', 8 => 'tám', 9 => 'chín'
        ];

        if (!is_numeric($number) || $number < 0) {
            return "Số không hợp lệ";
        }

        if ($number == 0) {
            return "không đồng";
        }

        $parts = array();
        $unitIndex = 0;

        while ($number > 0) {
            $chunk = $number % 1000;
            if ($chunk > 0) {
                $parts[] = convertThreeDigits($chunk, $numberWords) . ' ' . $units[$unitIndex];
            }
            $number = floor($number / 1000);
            $unitIndex++;
        }

        $words = implode(' ', array_reverse($parts));
        return ucfirst(trim($words)) . ' đồng';
    }
}

if (!function_exists('convertThreeDigits')) {
    function convertThreeDigits($number, $numberWords)
    {
        $hundreds = floor($number / 100);
        $tens = floor(($number % 100) / 10);
        $ones = $number % 10;

        $words = '';

        if ($hundreds > 0) {
            $words .= $numberWords[$hundreds] . ' trăm';
            if ($tens == 0 && $ones > 0) {
                $words .= ' linh';
            }
        }

        if ($tens > 1) {
            $words .= ' ' . ($tens == 1 ? 'mười' : $numberWords[$tens] . ' mươi');
            if ($ones == 1) {
                $words .= ' mốt';
            } elseif ($ones == 5) {
                $words .= ' lăm';
            } elseif ($ones > 0) {
                $words .= ' ' . $numberWords[$ones];
            }
        } elseif ($tens == 1) {
            $words .= ' mười';
            if ($ones > 0) {
                $words .= ' ' . $numberWords[$ones];
            }
        } elseif ($ones > 0) {
            $words .= ' ' . $numberWords[$ones];
        }

        return trim($words);
    }
}

if (!function_exists('formatVietnameseCurrencyText')) {
    function formatVietnameseCurrencyText($number) {
        if ($number < 1000000) {
            return 'Số không hợp lệ'; // Số nhỏ hơn 1 triệu không hợp lệ
        }

        if ($number > 100000000000000) {
            return 'Số quá lớn'; // Giới hạn 100 nghìn tỷ
        }

        $units = [
            1000000000000 => 'nghìn tỷ',
            1000000000 => 'tỷ',
            1000000 => 'triệu'
        ];

        $result = [];

        foreach ($units as $value => $unit) {
            if ($number >= $value) {
                $count = floor($number / $value);
                $number %= $value;
                $result[] = $count . ' ' . $unit;
            }
        }

        return implode(' ', $result);
    }
}


if(!function_exists('getCurrentSortItemClient')){
    function getCurrentSortItemClient($fieldSort = null, $order = null){
        if($fieldSort == 'created_at' && $order == 'desc'){
            return 'Mới nhất';
        }elseif($fieldSort == 'price' && $order == 'asc'){
            return 'Giá thấp nhất';
        }elseif($fieldSort == 'price' && $order == 'desc'){
            return 'Giá cao nhất';
        }elseif($fieldSort == 'area' && $order == 'desc'){
            return 'Diện tích lớn nhất';
        }elseif($fieldSort == 'area' && $order == 'asc'){
            return 'Diện tích nhỏ nhất';
        }

        return 'Mặc định';
    }
}


if (!function_exists('convertToLargeUnit')) {
    /**
     * Chuyển đổi số từ đơn vị nhỏ (trăm, nghìn, chục nghìn) sang đơn vị lớn (trăm triệu, tỉ, chục tỉ)
     *
     * @param int|float $number Số cần chuyển đổi
     * @return int|float Số sau khi chuyển đổi
     */
    function convertToLargeUnit($number)
    {
        // Giả định:
        // 100 - 999: hiểu là hàng trăm => nhân với 1,000,000 (triệu) để ra trăm triệu
        // 1000 - 9999: hiểu là hàng nghìn => nhân với 1,000,000 (triệu) để ra tỉ
        // 10000 trở lên: hiểu là chục nghìn => nhân với 1,000,000 (triệu) để ra chục tỉ

        if ($number >= 100 && $number < 1000) {
            // Hàng trăm -> trăm triệu
            return $number * 1000000;
        } elseif ($number >= 1000 && $number < 10000) {
            // Hàng nghìn -> tỉ
            return $number * 1000000;
        } elseif ($number >= 10000) {
            // Chục nghìn -> chục tỉ
            return $number * 1000000;
        }

        // Nếu số nhỏ hơn 100, trả về nguyên giá trị
        return $number;
    }
}
