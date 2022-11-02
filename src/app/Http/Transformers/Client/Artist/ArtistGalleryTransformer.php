<?php

declare(strict_types=1);

namespace App\Http\Transformers\Client\Artist;

use App\Doctrine\Entities\Data\ArtistGallery;
use App\Http\Dto\Client\Artist\ArtistGalleryDto;

final class ArtistGalleryTransformer
{
    public static function createDtoListFromEntityList(ArtistGallery ...$items): array
    {
        return array_map(fn(ArtistGallery $a) => self::createDtoFromEntity($a), $items);
    }

    public static function createDtoFromEntity(ArtistGallery $entity): ArtistGalleryDto
    {
        $dto = new ArtistGalleryDto();
        $dto->name = $entity->getName();
        $dto->location = $entity->getLocation();

        return $dto;
    }
}