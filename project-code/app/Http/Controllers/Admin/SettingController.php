<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\SettingRepositoryRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveSettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    protected $settingRepository;

    public function __construct(
        SettingRepositoryRepository $settingRepository
    )
    {
        $this->settingRepository = $settingRepository;
    }

    public function index()
    {
        $setting = $this->settingRepository->first();

        return view('admin.pages.setting.index', compact('setting'));
    }

    public function save(SaveSettingRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

            // handle upload logo & favicon
            $fileLogo = $request->file('web_logo');
            $fileFavicon = $request->file('web_favicon');
            $setting = $this->settingRepository->first();

            if ($fileLogo) {
                $fileNameLogo = 'logo_' . uniqid() . '.' . $fileLogo->getClientOriginalExtension();

                $path = $fileLogo->storeAs('uploads/setting', $fileNameLogo, 'public');

                // Lấy URL file đã upload
                $data['web_logo'] = $path;

                // remove old logo
                if(Storage::exists($setting?->web_logo)){
                    Storage::delete($setting?->web_logo);
                }
            }

            if ($fileFavicon) {
                $fileNameLogo = 'fav_' . uniqid() . '.' . $fileFavicon->getClientOriginalExtension();

                $path = $fileFavicon->storeAs('uploads/setting', $fileNameLogo, 'public');

                // Lấy URL file đã upload
                $data['web_favicon'] = $path;

                // remove old logo
                if(Storage::exists($setting?->web_favicon)){
                    Storage::delete($setting?->web_favicon);
                }
            }

            if ($setting) {
                $setting->update($data);
            } else {
                $this->settingRepository->create($data);
            }

            DB::commit();

            toastr()->success(trans('messages.update.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Có lỗi xảy ra', 'Error');
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function showSeoSetting()
    {
        return view('admin.pages.seo.index');
    }

    public function showAboutPage()
    {
        $setting = $this->settingRepository->first();

        return view('admin.pages.setting.about-us', compact('setting'));
    }

    public function saveAboutPage(Request $request)
    {
        try {
            $request->validate([
                'about_us' => 'nullable|string',
            ]);

            $setting = $this->settingRepository->first();
            $setting->update($request->all());

            toastr()->success(trans('messages.update.success'));

            return redirect()->back();
        }catch (\Exception $e) {
            toastr()->error(__('messages.server'));
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }
}
