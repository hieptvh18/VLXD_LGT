<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryRepository;
use App\Criteria\FilterCategoryCriteria;
use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryRepository->pushCriteria(new FilterCategoryCriteria()) // Áp dụng filter
                ->paginate(Constant::LIMIT_NUMBER);

        // cate edit
        $category = $request->edit ? $this->categoryRepository->find($request->edit) : null;

        return view('admin.pages.category.index', compact('categories', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        try {
            $formData = $request->all();
            $formData['is_active'] = $request->is_active ?? 0;
            $this->categoryRepository->create($formData);

            toastr()->success(__('messages.create.success'));
            return redirect()->route('admin.category.index');
        }catch (\Exception $e){
            Log::error($e->getMessage());
            toastr()->error(__('messages.create.error'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        try {
            $formData = $request->all();
            $formData['is_active'] = $request->is_active ?? 0;
            $this->categoryRepository->update($formData, $id);

            toastr(trans('messages.update.success'));
            return redirect()->route('admin.category.index');
        }catch (\Exception $e){
            toastr(trans('messages.update.error'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->categoryRepository->delete($id);

            toastr()->success(__('messages.delete.success'));
            return redirect()->back();
        }catch (\Throwable $th) {
            Log::error($th->getMessage());
            toastr()->error(__('messages.delete.error'));
            return redirect()->back();
        }
    }
}
