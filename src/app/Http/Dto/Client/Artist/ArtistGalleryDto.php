<?php

declare(strict_types=1);

namespace App\Http\Dto\Client\Artist;

/**
 * @OA\Schema(schema="ArtistGalleryDto", description="")
 */
class ArtistGalleryDto
{
    /**
     * @OA\Property(nullable=false)
     */
    public string $name;

    /**
     * @OA\Property()
     */
    public ?string $location = null;
}