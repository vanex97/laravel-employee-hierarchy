<?php

namespace App\Providers;

use App\Http\Resources\EmployeeTreeResource;
use Illuminate\Support\Facades\URL;
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
        EmployeeTreeResource::withoutWrapping();

        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
