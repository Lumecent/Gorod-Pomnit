<?php

namespace App\Containers\User\Routes\Api;

use App\Abstractions\Providers\RouteServiceProvider;
use App\Abstractions\Routes\ApiRoute;
use App\Containers\User\Controllers\Api\AuthController;

class ApiAuthRoute extends RouteServiceProvider
{
    public function routes(): void
    {
        ApiRoute::controller( AuthController::class )->prefix( 'api/v1/auth' )->group( function () {
            ApiRoute::post( 'registration', 'registration' );
        } );
    }
}
