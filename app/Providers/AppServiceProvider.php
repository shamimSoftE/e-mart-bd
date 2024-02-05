<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Popular;
use App\Models\SiteInfo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $info = SiteInfo::first();
        $categoriesMenu = Category::where('status',1)->where('parent_id', null)->where('menu_cate', 1)->latest()->get();
        $popularCategory = Popular::latest()->select('category_id')->groupBy('category_id')->latest()->limit(4)->get();
        $categories = Category::where('status',1)->where('parent_id', null)->get();
        View::share([
            'categoriesMenu' => $categoriesMenu,
            'categories' => $categories,
            'popularCategory' => $popularCategory,
            'info' => $info,
        ]);
    }
}
