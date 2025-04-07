<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\FeedbackRepository;
use App\Criteria\FeedbackCriteria;
use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveFeedbackRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{

    protected $feedbackRepository;

    public function __construct(
        FeedbackRepository $feedbackRepository
    )
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = $this->feedbackRepository
            ->pushCriteria(new FeedbackCriteria())
            ->paginate(Constant::LIMIT_NUMBER);

        return view('admin.pages.feedback.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveFeedbackRequest $request)
    {
        try {
            $formData = $request->all();
            $formData['is_active'] = $request->is_active ?? 0;
            $this->feedbackRepository->create($formData);

            toastr()->success(__('messages.create.success'));
            return redirect()->route('admin.feedback.index');
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
        $feedback = $this->feedbackRepository->find($id);

        if(!$feedback){
            return redirect()->route('feedback.index');
        }

        return view('admin.pages.feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveFeedbackRequest $request, string $id)
    {
        try {
            $formData = $request->all();
            $formData['is_active'] = $request->is_active ?? 0;
            $this->feedbackRepository->update($formData, $id);

            toastr(trans('messages.update.success'));
            return redirect()->route('admin.feedback.index');
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
            $this->feedbackRepository->delete($id);

            toastr()->success(__('messages.delete.success'));
            return redirect()->back();
        }catch (\Throwable $th) {
            Log::error($th->getMessage());
            toastr()->error(__('messages.delete.error'));
            return redirect()->back();
        }
    }
}
