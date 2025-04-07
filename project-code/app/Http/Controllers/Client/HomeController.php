<?php

namespace App\Http\Controllers\Client;

use App\Enums\CategoryTypeEnum;
use App\Enums\ItemStatusEnum;
use App\Enums\NewsStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Item;
use App\Models\News;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        // data categories + news first page
        // lấy 5 danh mục + 5 bản ghi tin tức có ngày tạo mới nhât cho mỗi danh mục
        $categoriesWithNews = Category::select('categories.id', 'categories.name', 'categories.is_active')
            ->where('categories.is_active', true)
            ->where('categories.type', CategoryTypeEnum::NEWS)
            ->take(5)
            ->get();

        // Lấy tất cả tin tức của 5 danh mục này trong **một truy vấn duy nhất**
        $newsOfCategories = News::select('news.id', 'news.title', 'news.slug', 'news.status', 'news.short_desc', 'news.created_at', 'categoryables.category_id')
            ->join('categoryables', function ($join) {
                $join->on('news.id', '=', 'categoryables.categoryable_id')
                    ->where('categoryables.categoryable_type', News::class);
            })
            ->whereIn('categoryables.category_id', $categoriesWithNews->pluck('id'))
            ->where('news.status', NewsStatusEnum::PUBLISH)
            ->orderBy('news.created_at', 'desc')
            ->get()
            ->groupBy('category_id'); // Nhóm theo category_id

        // Gán tin tức vào danh mục tương ứng
        $categoriesWithNews = $categoriesWithNews->map(function ($category) use ($newsOfCategories) {
            return [
                ...$category->toArray(),
                'news' => $newsOfCategories[$category->id]->take(5) ?? []
            ];
        });


        // list tin tuc noi bat
        $newsFeatureds = News::select('id', 'title', 'slug')
            ->where('status', NewsStatusEnum::PUBLISH)
            ->where('is_first_page', false)
            ->where('is_featured', true)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();


        return view('clients.pages.home.index', [
            'newsFeatureds' => $newsFeatureds ?? [],
            'categoriesWithNews' => $categoriesWithNews ?? [],
        ]);
    }
}
