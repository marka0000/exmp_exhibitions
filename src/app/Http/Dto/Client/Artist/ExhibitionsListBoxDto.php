<?php

declare(strict_types=1);

namespace App\Http\Dto\Client\Artist;

use App\Modules\OpenApi\Annotations as API;

/**
 * @OA\Schema(schema="ArtistExhibitionsListBoxDto", description="")
 */
class ExhibitionsListBoxDto extends \JsonSerializable
{
    /**
     * @API\Property(type="App\Http\Dto\Guest\Artist\ArtistExhibitionDto[]")
     */
    private array $exhibitions;

    /**
     * @API\Property(type="App\Http\Dto\Guest\Artist\ArtistGalleryDto[]")
     */
    private array $galleries;

    public function __construct(array $exhibitions = [], array $galleries = [])
    {
        $this->exhibitions = $exhibitions;
        $this->galleries = $galleries;
    }

    public function jsonSerialize(): array
    {
        return [
            'exhibitions' => $this->exhibitions,
            'galleries' => $this->galleries,
        ];
    }
}