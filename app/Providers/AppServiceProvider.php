<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Asset;
use App\Observers\AssetObserver;
use App\Models\Signal;
use App\Observers\SignalObserver;
use App\Models\Scanner;
use App\Observers\ScannerObserver;
use App\User;
use App\Observers\UserObserver;

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
        Schema::defaultStringLength(191);
        Signal::observe(SignalObserver::class);
        Scanner::observe(ScannerObserver::class);
        User::observe(UserObserver::class);
        Asset::observe(AssetObserver::class);
    }
}
