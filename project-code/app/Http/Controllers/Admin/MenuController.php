<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\MenuRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveMenuRequest;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    protected $menuRepository;

    public function __construct(
        MenuRepository $menuRepository
    )
    {
        $this->menuRepository = $menuRepository;
    }

    public function index()
    {
        $setting = $this->menuRepository->first();

        return view('admin.pages.setting.menu-setting', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveMenuRequest $request)
    {
        try {
            dd($request->all());
        }catch (\Exception $exception){
            toastr()->error(__('messages.server'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
