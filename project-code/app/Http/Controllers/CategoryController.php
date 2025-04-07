<?php

namespace App\Http\Controllers;

use App\Enums\CategoryTypeEnum;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function getAllCategories(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->where('type', CategoryTypeEnum::ITEM)
            ->get();
        $result = $categories?->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });

        return response()->json($result);
    }
}
