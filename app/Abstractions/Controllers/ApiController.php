<?php

namespace App\Abstractions\Controllers;

/**
 * @OA\Info(
 *     title="Город помнит Swagger API documentation",
 *     version="1.0.0"
 * )
 *
 * @OA\PathItem(
 *     path="/auth",
 * )
 *
 * @OA\Tag(
 *     name="User",
 * )
 *
 * @OA\Server(
 *     description="Город помнит Swagger API server",
 *     url="http://localhost:8885/api/v1"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     in="header",
 *     name="Authorization",
 *     type="http",
 *     scheme="Bearer",
 *     bearerFormat="JWT",
 * )
 */
abstract class ApiController extends Controller
{

}
