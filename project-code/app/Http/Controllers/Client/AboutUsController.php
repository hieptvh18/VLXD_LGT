<?php

namespace App\Http\Controllers\Client;

use App\Contracts\SettingRepositoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
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
        return view('clients.pages.about-us.index', compact('setting'));
    }
}
