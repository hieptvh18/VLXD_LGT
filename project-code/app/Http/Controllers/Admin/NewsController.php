<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\NewsRepository;
use App\Criteria\NewsCriteria;
use App\Events\SaveIsFirstPageNews;
use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateNewsRequest;
use App\Http\Requests\Admin\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewsController extends Controller
{

    protected $newsRepository;

    public function __construct(
        NewsRepository $newsRepository
    )
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = $this->newsRepository
            ->pushCriteria(new NewsCriteria())
            ->with(['categories', 'creator', 'updater'])
            ->paginate(Constant::LIMIT_NUMBER);

        $categories = getNewsCategories();

        return view('admin.pages.news.index', compact('news', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = getNewsCategories();
        return view('admin.pages.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewsRequest $request)
    {
        try {
            DB::beginTransaction();

            $formData = $request->all();

            $lastItem = News::count() ?? 0;
            $formData['is_featured'] =  $request->is_featured ?? 0;
            $formData['is_first_page'] =  $request->is_first_page ?? 0;
            $formData['slug'] =  Str::slug($request->title) . '-' . $lastItem + 1;
            $news = $this->newsRepository->create($formData);

            // save categories to news
            $news->categories()->attach($request->category_ids);

            // Upload ảnh đại diện
            if ($request->hasFile('featured_image')) {
                $news->clearMediaCollection('featured_image'); // Xóa ảnh đại diện cũ
                $news->addMedia($request->file('featured_image'))
                    ->toMediaCollection('featured_image');
            }

            DB::commit();

            // unset tin tức khác mà có được đánh flag first_page vì chỉ có 1 item có attr này.
            if($request->is_first_page){
                event(new SaveIsFirstPageNews($news));
            }

            toastr()->success(trans('messages.create.success'));
            return redirect()->route('admin.news.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception);
            toastr()->error(trans('messages.create.error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::with(['categories'])->where('id', $id)->first();

        if(!$news){
            abort(404);
        }

        $categories = getNewsCategories();

        return view('admin.pages.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, string $id)
    {
        try {
            $news = $this->newsRepository->find($id);

            if(!$news){
                abort(404);
            }

            DB::beginTransaction();
            $formData = $request->all();
            $formData['is_featured'] =  $request->is_featured ?? 0;
            $formData['is_first_page'] =  $request->is_first_page ?? 0;

            $news = $this->newsRepository->update($formData, $id);

            // save categories to news
            $news->categories()->sync($request->category_ids);

            // Upload ảnh đại diện
            if ($request->hasFile('featured_image')) {
                $news->clearMediaCollection('featured_image'); // Xóa ảnh đại diện cũ
                $news->addMedia($request->file('featured_image'))
                    ->toMediaCollection('featured_image');
            }

            DB::commit();

            // unset tin tức khác mà có được đánh flag first_page vì chỉ có 1 item có attr này.
            if($request->is_first_page){
                event(new SaveIsFirstPageNews($news));
            }

            toastr()->success(trans('messages.update.success'));
            return redirect()->route('admin.news.index');
        }catch (\Exception $exception){
            dd($exception);
            DB::rollBack();
            Log::error($exception);
            toastr()->error(trans('messages.update.error'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->newsRepository->delete($id);

            toastr()->success(__('messages.delete.success'));
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            toastr()->error(__('messages.delete.error'));
            return redirect()->back();
        }
    }
}
