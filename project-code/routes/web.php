<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\ItemController as ClientItemController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// ======================= ADMIN =================
Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth.admin',
    'as' => 'admin.',
], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // user
    Route::resource('user', UserController::class);

    // category
    Route::resource('category', CategoryController::class);

    // feedback
    Route::resource('feedback', FeedbackController::class);

    // contact
    Route::resource('contact', \App\Http\Controllers\Admin\ContactController::class);

    // bds
    Route::resource('item', ItemController::class);
    // save media image item
    Route::post('item/{item_id}/media', [ItemController::class, 'saveMedia'])->name('item.media.save');

    // news
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);

    // setting
    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
//    Route::get('setting-menu', [SettingController::class, 'showSettingMenu'])->name('setting.menu.index');
    Route::resource('menu', \App\Http\Controllers\Admin\MenuController::class);
    Route::post('setting', [SettingController::class, 'save'])->name('setting.save');
    // setting about page
    Route::get('setting/about-page', [SettingController::class, 'showAboutPage'])->name('setting.aboutus.index');
    Route::post('setting/about-page', [SettingController::class, 'saveAboutPage'])->name('setting.aboutus.save');
    // SEO
    Route::get('seo', [SettingController::class, 'showSeoSetting'])->name('setting.seo.index');
});

// ======================= ANY =====================
Route::group([
    'as' => 'client.',
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // blog
    Route::get('/tin-tuc', [BlogController::class, 'index'])->name('blog');
    Route::get('/tin-tuc/{slug}', [BlogController::class, 'show'])->name('blog.detail');

    // page bds
    Route::get('/bat-dong-san', [ClientItemController::class, 'index'])->name('item');
    Route::get('/bat-dong-san/{slug}', [ClientItemController::class, 'show'])->name('item.detail');

    // about us page
    Route::get('/gioi-thieu', [\App\Http\Controllers\Client\AboutUsController::class, 'index'])->name('aboutus');
});

// ======================= AUTH =====================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // change password
    Route::patch('/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
});

require __DIR__ . '/auth.php';
