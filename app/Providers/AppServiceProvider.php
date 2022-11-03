<?php

namespace App\Providers;

use App\Services\ICategoriaService;
use App\Services\CategoriaService;
use App\Services\IVideoService;
use App\Services\VideoService;
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
        $this->app->bind(ICategoriaService::class, CategoriaService::class);
        $this->app->bind(IVideoService::class, VideoService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
