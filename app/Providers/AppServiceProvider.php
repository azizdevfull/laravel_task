<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

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
        Response::macro('success', function ($data = null, $msg = null, $status = 200) {
            return Response::json([
                'message' => $msg,
                'data' => $data,
            ], $status);
        });
        Response::macro('error', function ($msg = null, $status = 422) {
            return Response::json([
                'message' => $msg,
            ], $status);
        });
    }
}
