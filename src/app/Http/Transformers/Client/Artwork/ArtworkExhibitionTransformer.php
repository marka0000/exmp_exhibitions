<?php

declare(strict_types=1);

namespace App\Http\Transformers\Client\Artwork;

use App\Doctrine\Entities\Data\ArtworkExhibition;
use App\Http\Dto\Client\Artwork\ArtworkExhibitionDto;
use App\Http\Dto\Client\Artwork\ArtworkExhibitionGroupDto;

final class ArtworkExhibitionTransformer
{
    private const NULLABLE_YEAR = 0;

    public static function createDtoListFromEntityList(ArtworkExhibition ...$items): array
    {
        return array_map(fn(ArtworkExhibition $a) => self::createDtoFromEntity($a), $items);
    }

    public static function createDtoFromEntity(ArtworkExhibition $entity): ArtworkExhibitionDto
    {
        $dto = new ArtworkExhibitionDto();
        $dto->title = $entity->getTitle();
        $dto->year = $entity->getYear();
        $dto->location = $entity->getLocation();
        $dto->gallery = $entity->getGallery();

        return $dto;
    }

    public static function createGroupDtoEntity(ArtworkExhibitionDto ...$exhibitions): array
    {
        $groupYearExhibitions = self::groupByExhibitionYear(...$exhibitions);

        uksort($groupYearExhibitions, fn (int $a, int $b) => $b <=> $a);

        $groupExhibitions = [];

        foreach ($groupYearExhibitions as $year => $list) {
            $dto = new ArtworkExhibitionGroupDto();
            $dto->year = $year === self::NULLABLE_YEAR ? null : $year;
            $dto->list = $list;

            $groupExhibitions[] = $dto;
        }

        return $groupExhibitions;
    }

    private static function groupByExhibitionYear(ArtworkExhibitionDto ...$exhibitions): array
    {
        $exhibitionsGroup = [];

        foreach ($exhibitions as $exhibition) {
            $year = $exhibition->year ?? self::NULLABLE_YEAR;

            if (!isset($exhibitionsGroup[$year])) {
                $exhibitionsGroup[$year] = [];
            }

            $exhibitionsGroup[$year][] = $exhibition;
        }

        return $exhibitionsGroup;
    }
}