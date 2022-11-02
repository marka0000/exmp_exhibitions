<?php

declare(strict_types=1);

namespace App\Http\Dto\Client\Artist;

/**
 * @OA\Schema(schema="ArtistExhibitionGroupDto", description="")
 */
class ArtistExhibitionGroupDto
{
    /**
     * @OA\Property()
     */
    public ?int $year = null;

    /**
     * @OA\Property(nullable=true, type="array", @OA\Items(ref="#/components/schemas/ArtistExhibitionDto"))
     */
    public ?array $list = null;
}