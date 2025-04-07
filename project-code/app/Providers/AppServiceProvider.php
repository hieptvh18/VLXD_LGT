<?php

namespace App\Providers;

use App\Contracts\CategoryRepository;
use App\Contracts\ContactRepository;
use App\Contracts\FeedbackRepository;
use App\Contracts\ItemRepository;
use App\Contracts\MenuRepository;
use App\Contracts\NewsRepository;
use App\Contracts\SettingRepositoryRepository;
use App\Contracts\UserRepository;
use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\ContactRepositoryEloquent;
use App\Repositories\FeedbackRepositoryEloquent;
use App\Repositories\ItemRepositoryEloquent;
use App\Repositories\MenuRepositoryEloquent;
use App\Repositories\NewsRepositoryEloquent;
use App\Repositories\SettingRepositoryRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(SettingRepositoryRepository::class, SettingRepositoryRepositoryEloquent::class);
        $this->app->bind(FeedbackRepository::class, FeedbackRepositoryEloquent::class);
        $this->app->bind(ItemRepository::class, ItemRepositoryEloquent::class);
        $this->app->bind(NewsRepository::class, NewsRepositoryEloquent::class);
        $this->app->bind(ContactRepository::class, ContactRepositoryEloquent::class);
        $this->app->bind(MenuRepository::class, MenuRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
