<?php

namespace App\Containers\User\Services;

use App\Abstractions\DTO\Dto;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LoadAvatarUserService
{
    private const IMAGE_PATH = 'images/user/%s/avatar.jpg';

    public function run( Dto $dto ): string
    {
        $image = Image::make( $dto->avatar );
        $imagePath = sprintf( self::IMAGE_PATH, $dto->id );

        $binaryImage = $image->response( null, 60 )->getContent();

        Storage::put( $imagePath, $binaryImage );

        return $imagePath;
    }
}
