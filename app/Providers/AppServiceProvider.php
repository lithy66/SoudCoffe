<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use App\View\Composers\NotificationComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       $settings = Setting::checkSettings();
       view()->share([
           'setting' => $settings
       ]);

       $admin = Admin::checkAdmin();

        View::composer('admin.layouts.main-header', NotificationComposer::class);

        Paginator::useBootstrapFour();

    }
}
