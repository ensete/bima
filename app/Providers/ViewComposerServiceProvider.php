<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Manga;
use App\Blog;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot() {
        $this->composeSidebar();
        $this->composeHeader();
    }

    public function register()
    {
        //
    }

    private function composeSidebar() {
        view()->composer('elements.sidebar', function($view) {
            //$data['posts'] = Blog::prominentPosts(3);
            $data['manga'] = Manga::orderByRaw("RAND()")->limit(5)->get();
            $view->with('data', $data);
        });
    }

    private function composeHeader() {
        view()->composer('elements.header', function($view) {
            $composer['user'] = userAuthentication();
            $view->with('composer', $composer);
        });
    }
}

