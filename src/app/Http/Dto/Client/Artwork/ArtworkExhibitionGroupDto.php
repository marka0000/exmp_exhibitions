<?php

declare(strict_types=1);

namespace App\Http\Dto\Client\Artwork;

use App\Modules\OpenApi\Annotations as API;

/**
 * @OA\Schema(schema="ArtworkExhibitionGroupDto", description="")
 */
class ArtworkExhibitionGroupDto
{
    /**
     * @OA\Property()
     */
    public ?int $year = null;

    /**
     * @API\Property(type="App\Http\Dto\Guest\Artwork\ArtworkExhibitionDto[]", nullable=true)
     *
     * @OA\Property(nullable=true, type="array", @OA\Items(ref="#/components/schemas/ArtworkExhibitionDto"))
     */
    public ?array $list = null;
}