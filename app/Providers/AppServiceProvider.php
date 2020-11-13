<?php

namespace App\Providers;

use App\Http\Controllers\CustomerDetailsController;
use App\Http\Controllers\CustomersController;
use App\Services\BigcommerceService;
use Bigcommerce\Api\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('API_STORE_URL')) {
            Client::configure([
                'store_url' => env('API_STORE_URL'),
                'username' => env('API_USERNAME'),
                'api_key' => env('API_KEY'),
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CustomersController::class, function ($app) {
            return new CustomersController($app[BigcommerceService::class]);
        });

        $this->app->singleton(CustomerDetailsController::class, function ($app) {
            return new CustomerDetailsController($app[BigcommerceService::class]);
        });
    }
}
