<?php

namespace App\Providers;

use App\Services\IVideoService;
use App\Services\VideoService;
use Illuminate\Support\ServiceProvider;
use Tests\Feature\VideoTest;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
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
