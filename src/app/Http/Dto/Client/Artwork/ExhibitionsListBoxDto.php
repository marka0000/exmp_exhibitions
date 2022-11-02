<?php

declare(strict_types=1);

namespace App\Http\Dto\Client\Artwork;

use App\Modules\OpenApi\Annotations as API;

/**
 * @OA\Schema(schema="ArtworkExhibitionsListBoxDto", description="")
 */
class ExhibitionsListBoxDto extends \JsonSerializable
{
    /**
     * @API\Property(type="App\Http\Dto\Guest\Artwork\ArtworkExhibitionGroupDto[]")
     */
    private array $exhibitions;

    public function __construct(array $exhibitions)
    {
        $this->exhibitions = $exhibitions;
    }

    public function jsonSerialize(): array
    {
        return [
            'exhibitions' => $this->exhibitions,
        ];
    }
}