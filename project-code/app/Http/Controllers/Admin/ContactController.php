<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ContactRepository;
use App\Criteria\ContactCriteria;
use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveContactRequest;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{

    protected $contactRepository;

    public function __construct(
        ContactRepository $contactRepository
    )
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = $this->contactRepository
            ->pushCriteria(new ContactCriteria())
            ->paginate(Constant::LIMIT_NUMBER);

        return view('admin.pages.contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveContactRequest $request)
    {
        try {
            $formData = $request->all();
            $formData['ip'] = $request->ip();
            $this->contactRepository->create($formData);

            toastr()->success(__('messages.create.success'));
            return redirect()->route('admin.contact.index');
        }catch (\Exception $e){
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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = $this->contactRepository->with(['item' => fn($query) => $query->withTrashed()])
            ->where('id', $id)
            ->first();

        if(!$contact){
            return redirect()->route('contact.index');
        }

        return view('admin.pages.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveContactRequest $request, string $id)
    {
        try {
            $formData = $request->all();
            $formData['ip'] = $request->ip();
            $this->contactRepository->update($formData, $id);

            toastr(trans('messages.update.success'));
            return redirect()->route('admin.contact.index');
        }catch (\Exception $e){
            Log::error($e->getMessage());
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
            $this->contactRepository->delete($id);

            toastr()->success(__('messages.delete.success'));
            return redirect()->back();
        }catch (\Throwable $th) {
            Log::error($th->getMessage());
            toastr()->error(__('messages.delete.error'));
            return redirect()->back();
        }
    }
}
