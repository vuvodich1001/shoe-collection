<?php

namespace App\Providers;

use App\Repositories\Shoe\ShoeRepository;
use App\Repositories\Shoe\ShoeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton(ShoeRepositoryInterface::class, ShoeRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }
}
