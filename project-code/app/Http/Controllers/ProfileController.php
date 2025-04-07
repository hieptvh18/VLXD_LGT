<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\ChangePasswordRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('clients.pages.profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            toastr()->success(__('messages.update.success'));
            return redirect()->back();
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            toastr()->error(__('messages.server'));
            return redirect()->back();
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = auth()->user();
            $user->password = bcrypt($request->new_password);
            $user->save();

            toastr()->success(__('password-changed'));
            return redirect()->back();
        }catch (\Exception $exception){
            toastr()->error('messages.server');
            Log::error($exception->getMessage());
            return Redirect::back()->with('error', $exception->getMessage());
        }
    }
}
