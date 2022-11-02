<?php

declare(strict_types=1);

namespace App\Http\Dto\Client\Artwork;

/**
 * @OA\Schema(schema="ArtworkExhibitionDto", description="")
 */
class ArtworkExhibitionDto
{
    /**
     * @OA\Property(nullable=false)
     */
    public ?string $title = null;

    /**
     * @OA\Property()
     */
    public ?string $location = null;

    /**
     * @OA\Property()
     */
    public ?string $gallery = null;

    /**
     * @OA\Property()
     */
    public ?int $year = null;
}