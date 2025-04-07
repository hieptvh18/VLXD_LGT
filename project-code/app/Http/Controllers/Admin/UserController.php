<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UserRepository;
use App\Criteria\FilterUserCriteriaCriteria;
use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->pushCriteria(new FilterUserCriteriaCriteria()) // Áp dụng filter
                                        ->paginate(Constant::LIMIT_NUMBER);

        return view('admin.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            return view('admin.pages.user.create');
        }catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $formData = $request->all();
            $formData['password'] = bcrypt($request->password);
            $this->userRepository->create($formData);

            toastr()->success(__('messages.create.success'));
            return redirect()->route('admin.user.index');
        }catch (\Exception $e){
            Log::error($e->getMessage());
            toastr()->error(__('messages.create.error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        try{
            $user = $this->userRepository->findOrFail($id);
            return view('admin.pages.user.edit', compact('user'));
        }catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $this->userRepository->update($request->all(), $id);

            toastr(trans('messages.update.success'));
            return redirect()->route('admin.user.index');
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
            $this->userRepository->delete($id);

            toastr()->success(__('messages.delete.success'));
            return redirect()->back();
        }catch (\Throwable $th) {
            Log::error($th->getMessage());
            toastr()->error(__('messages.delete.error'));
            return redirect()->back();
        }
    }
}
