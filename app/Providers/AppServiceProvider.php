<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Post;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //При загрузке сайт-бара где бы он не был, запускаем функцию
        view()->composer('pages._sidebar', function($view) {
           $view->with('popularPosts', Post::orderBy('views', 'desc')->take(3)->get());
           $view->with('featuredPosts', Post::where('is_featured', 1)->take(3)->get());
           $view->with('newPosts', Post::orderBy('date', 'desc')->take(4)->get());
           $view->with('categories', Category::all());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
