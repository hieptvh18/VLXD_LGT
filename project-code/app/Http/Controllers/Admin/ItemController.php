<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ItemRepository;
use App\Criteria\ItemCriteria;
use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateItemRequest;
use App\Http\Requests\Admin\SaveMediaRequest;
use App\Models\Category;
use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ItemController extends Controller
{

    protected $itemRepository;

    protected $itemService;

    public function __construct(
        ItemRepository $itemRepository,
        ItemService $itemService,
        )
    {
        $this->itemRepository = $itemRepository;
        $this->itemService = $itemService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = getItemCategories();

        $items = $this->itemRepository
            ->with(['categories'])
            ->pushCriteria(new ItemCriteria())
            ->paginate(Constant::LIMIT_NUMBER);

        return view('admin.pages.item.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = getItemCategories();

        return view('admin.pages.item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateItemRequest $request)
    {
        try {
            $data = $request->all();
            $data['is_featured'] = $request->is_featured ?? 0;

            DB::beginTransaction();


            // handle upload logo & favicon
            $fileLogo = $request->file('featured_image');

            if ($fileLogo) {
                $fileNameLogo = 'bds_' . uniqid() . '.' . $fileLogo->getClientOriginalExtension();

                $path = $fileLogo->storeAs('uploads/bds', $fileNameLogo, 'public');
                $fullUrlLogo = asset("storage" . DIRECTORY_SEPARATOR . $path);

                // Lấy URL file đã upload
                $data['featured_image'] = $fullUrlLogo;
            }

            // auto generate slug from item name
            $lastItem = Item::count();
            $data['slug'] =  Str::slug($request->item_name) . '-' . $lastItem + 1;

            $item = $this->itemRepository->create($data);

            // save category to item bds
            $item->categories()->attach($request->category_ids);

            DB::commit();

            toastr()->success(__('messages.create.success'));
            return redirect()->route('admin.item.edit', ['item' => $item->id, 'view' => 'media']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            toastr()->error(__('messages.create.error'));
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
    public function edit(Request $request, string $id)
    {
        $view = $request->view ?? Constant::ITEM_EDIT_VIEW_INFO;
        $categories = getItemCategories();
        $item = $this->itemRepository
            ->with(['categories'])
            ->where('id', $id)
            ->first();

        if ($view == Constant::ITEM_EDIT_VIEW_INFO) {
            return view('admin.pages.item.edit.edit-form', compact('categories', 'item'));
        }
        return view('admin.pages.item.edit.media-form', compact('categories', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateItemRequest $request, string $id)
    {
        try {
            $data = $request->all();
            $data['is_featured'] = $request->is_featured ?? 0;

            DB::beginTransaction();


            // handle upload logo & favicon
            $fileLogo = $request->file('featured_image');

            if ($fileLogo) {
                $fileNameLogo = 'bds_' . uniqid() . '.' . $fileLogo->getClientOriginalExtension();

                $path = $fileLogo->storeAs('uploads/bds', $fileNameLogo, 'public');
                $fullUrlLogo = asset("storage" . DIRECTORY_SEPARATOR . $path);

                // Lấy URL file đã upload
                $data['featured_image'] = $fullUrlLogo;
            }

            // auto generate slug from item name
            $lastItem = Item::count();
            $data['slug'] =  Str::slug($request->item_name) . '-' . $lastItem + 1;

            $item = $this->itemRepository->update($data, $id);

            // save category to item bds
            $item->categories()->sync($request->category_ids);

            DB::commit();

            toastr()->success(__('messages.create.success'));
            return redirect()->route('admin.item.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            toastr()->error(__('messages.create.error'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->itemRepository->delete($id);

            toastr()->success(__('messages.delete.success'));
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            toastr()->error(__('messages.delete.error'));
            return redirect()->back();
        }
    }

    public function saveMedia(SaveMediaRequest $request, $id)
    {
        try{
            $item = $this->itemRepository->find($id);

            if(!$item){
                toastr()->error('Không tìm thấy BDS');
                return redirect()->back();
            }

            // Xóa ảnh chi tiết cũ nếu có yêu cầu
            if ($request->has('delete_images')) {
                foreach ($request->delete_images as $mediaId) {
                    $media = Media::find($mediaId);
                    if ($media) {
                        $media->delete(); // Xóa ảnh khỏi storage
                    }
                }
            }

            // Upload ảnh đại diện
            if ($request->hasFile('featured_image')) {
                $item->clearMediaCollection('featured_image'); // Xóa ảnh đại diện cũ
                $item->addMedia($request->file('featured_image'))
                    ->toMediaCollection('featured_image');
            }

            // Upload ảnh chi tiết mới
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $item->addMedia($image)
                        ->toMediaCollection('images');
                }
            }

            toastr()->success('Upload success!');
            return redirect()->back();

            // $this->itemService->uploadAndSaveMedia();
        }catch(\Throwable $e){
            dd($e);
            toastr()->error('Upload fail');
            Log::error('Upload media item error: '. $e->getMessage());
            return redirect()->back();
        }
    }
}
