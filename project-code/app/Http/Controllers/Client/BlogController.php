<?php

namespace App\Http\Controllers\Client;

use App\Enums\NewsStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $newsFirstPage = null;
        $listNewsFeatured = null;
        // nếu filter theo category thì set null cho block first page vs list featureds
        if(!$request->c){
            // lấy tin tức được setting lên trang đầu hoặc nếu k có thì lấy tin nổi bật hoặc tin bình thường sort mới nhất
            $newsFirstPage = News::where('is_first_page', true)
                ->orWhere('is_featured', true)
                ->where('status', NewsStatusEnum::PUBLISH)
                ->orderByDesc('is_first_page')
                ->orderByDesc('created_at')
                ->first();

            // lấy list  3 tin tức nổi bật còn lại
            $listNewsFeatured = News::where('is_featured', true)
                ->where('is_first_page', false)
                ->where('status', NewsStatusEnum::PUBLISH)
                ->orderByDesc('created_at')
                ->limit(3)
                ->get();
        }

        // list normal news
        $listNews = News::with(['creator','updater','categories'])
            ->where('is_first_page', false)
            ->when($listNewsFeatured && $listNewsFeatured->count(), function ($query) use ($listNewsFeatured) {
                $query->whereNotIn('id', $listNewsFeatured->pluck('id'));
            })
            ->when($request->c, function ($query) use ($request) {
                $query->whereHas('categories', function ($query) use ($request) {
                   $query->where('categories.id', $request->c);
                });
            })
            ->where('status', NewsStatusEnum::PUBLISH)
            ->orderByDesc('created_at')
            ->paginate(5);

        // list categories limit = 10
        $categories = Category::select('id','name')->with(['news'])
            ->orderBy('id')
            ->where('type', true)
            ->limit(10)
            ->get();

        return view('clients.pages.blog.index', [
            'newsFirstPage' => $newsFirstPage ?? null,
            'listNews' => $listNews ?? collect(),
            'listNewsFeatured' => $listNewsFeatured ?? collect(),
            'categories' => $categories ?? collect(),
        ]);
    }

    public function show($slug)
    {
        $news = News::with(['creator','updater','categories'])
            ->where('slug', $slug)
            ->where('status', NewsStatusEnum::PUBLISH)
            ->firstOrFail();

        $newsRelated = News::select('id', 'title', 'slug')
            ->where('status', NewsStatusEnum::PUBLISH)
            ->whereHas('categories', function ($query) use ($news) {
                $categoryRelated = $news->categories->pluck('id')->toArray();
                $query->whereIn('categories.id', $categoryRelated);
            })
            ->where('slug', '!=', $slug)
            ->limit(10)
            ->get();

        // list categories limit = 10
        $categories = Category::select('id','name')->with(['news'])
            ->orderBy('id')
            ->limit(10)
            ->get();

        return view('clients.pages.blog.detail', compact('news', 'categories', 'newsRelated'));
    }
}
