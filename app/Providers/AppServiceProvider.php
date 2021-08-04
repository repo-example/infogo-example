<?php

namespace App\Providers;

use App\Http\Respond;
use App\Services\MessageServiceInterface;
use App\Services\RedisMessageService;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;
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
        // providers
        $this->app->register(RepositoryServiceProvider::class);

        // services
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(MessageServiceInterface::class, RedisMessageService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();

        // macros
        Response::macro('success', function ($value) {
            return Respond::success($value);
        });

        Response::macro('fail', function ($errorMessage, $statusCode = 200, $errorCode = -1) {
            return Respond::fail($errorMessage, $statusCode, $errorCode);
        });
    }
}
