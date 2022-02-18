<?php

namespace App\Containers\User\Routes\Api;

use App\Abstractions\Providers\RouteServiceProvider;
use App\Abstractions\Routes\ApiRoute;
use App\Containers\User\Controllers\Api\UserController;

class UserRoute extends RouteServiceProvider
{
    public function routes(): void
    {
        ApiRoute::controller( UserController::class )->prefix( 'api/v1/user' )->group( function () {
            ApiRoute::get('/', 'show');

            ApiRoute::middleware( 'auth:sanctum' )->put( '/{id}/update', 'update' );
            ApiRoute::middleware( 'auth:sanctum' )->post( '/{id}/verified-email', 'verifiedEmail' );

        } );
    }
}
