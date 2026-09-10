<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Fruitcake\LaravelDebugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Redis;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();

        Debugbar::setStorage(null);


        view()->composer('layouts.sidebar', function($view) {

            if (Cache::has('cats')) {
                $cats = Category::hydrate(json_decode(Cache::get('cats'), true));
            } else {
                $cats = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
                //Debugbar::info($cats);
                Cache::put('cats', json_encode($cats), 1);
            }

            if (Redis::exists('popular_posts')) {
                $popular_posts = Post::hydrate(json_decode(Redis::get('popular_posts'), true));
            } else {
                $popular_posts = Post::orderBy('views', 'desc')->limit(3)->get();
                Redis::set('popular_posts', json_encode($popular_posts));
            }

            $view->with('popular_posts', $popular_posts);
            $view->with('cats', $cats);

        });
    }
}
