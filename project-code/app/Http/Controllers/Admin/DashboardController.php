<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ItemStatusEnum;
use App\Enums\NewsStatusEnum;
use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Get data dashboard admin page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {

        // show table list user đăng nhập hệ thống gân
        $listUserLastLogined = User::select('*')
            ->orderByDesc('last_activity')
            ->limit(4)
            ->get();

        // list tin tuc dang gan nhat
        $listNewsNewest = News::select('*')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        // count user
        $totalAccount = User::count() ?? 0;
        $totalAccountCustomer = User::where('role', Constant::USER_CUSTOMER_ROLE)->count() ?? 0;
        // count news & category
        $totalNews = News::count() ?? 0;
        $totalNewsPublish = News::where('status', NewsStatusEnum::PUBLISH)->count() ?? 0;

        return view('admin.pages.dashboards.index', [
            'listUserLastLogined' => $listUserLastLogined,
            'listNewsNewest' => $listNewsNewest,
            'totalAccount' => number_format($totalAccount),
            'totalAccountCustomer' => number_format($totalAccountCustomer),
            'totalNews' => number_format($totalNews),
            'totalNewsPublish' => number_format($totalNewsPublish),
            'totalItem' => number_format(0),
            'countItemSold' => number_format(0),
            'countItemSoldRate' => 0,
            'totalAmountItemSold' => 0,
        ]);
    }
}
