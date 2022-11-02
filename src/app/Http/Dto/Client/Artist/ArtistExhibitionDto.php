<?php

declare(strict_types=1);

namespace App\Http\Dto\Client\Artist;

/**
 * @OA\Schema(schema="ArtistExhibitionDto", description="")
 */
class ArtistExhibitionDto
{
    /**
     * @OA\Property(nullable=false)
     */
    public string $type;

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