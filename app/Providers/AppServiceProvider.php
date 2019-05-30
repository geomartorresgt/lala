<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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

        Blade::directive('include2', function ($path_relative) {
            $requestUri = parse_url($_SERVER['REQUEST_URI'])['path'];
            $requestUri = explode('public/', $requestUri)[1];
            $requestUri = str_replace('/create', '', $requestUri);
            $view_file_root =  str_replace('/', '.', $requestUri); // you need to find this path with help of php functions, try some of them.
            $full_path = $view_file_root . $path_relative;
            $full_path = str_replace(['"', "'"], '', $full_path);

            dd($full_path);
            return view::make($full_path)->render();
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
