<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('sections.sidebar', function ($view) {
            $view->with('recentPosts', Post::with(['category:id,title,slug', 'user:id,name', 'tags:id,title,slug'])->recent(3)->get());

            $view->with('categories', Category::getFromCache());

            $view->with('tags', Tag::getFromCache());
        });

        View::composer('sections.carousel', function ($view) {
            $view->with('popularPosts', Post::with(['category:id,title,slug', 'user:id,name'])->popular()->get());
        });
    }
}
