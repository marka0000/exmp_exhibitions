<?php

declare(strict_types=1);

namespace App\Http\Transformers\Client\Artist;

use App\Doctrine\Entities\Data\ArtistExhibition;
use App\Http\Dto\Client\Artist\ArtistExhibitionDto;
use App\Http\Dto\Client\Artist\ArtistExhibitionGroupDto;

final class ArtistExhibitionTransformer
{
    private const NULLABLE_YEAR = 0;

    public static function createDtoListFromEntityList(ArtistExhibition ...$items): array
    {
        return array_map(fn(ArtistExhibition $a) => self::createDtoFromEntity($a), $items);
    }

    public static function createDtoFromEntity(ArtistExhibition $entity): ArtistExhibitionDto
    {
        $dto = new ArtistExhibitionDto();
        $dto->title = $entity->getTitle();
        $dto->type = $entity->getType();
        $dto->year = $entity->getYear();
        $dto->location = $entity->getLocation();
        $dto->gallery = $entity->getGallery();

        return $dto;
    }

    public static function createGroupDtoEntity(ArtistExhibitionDto ...$exhibitions): array
    {
        $groupYearExhibitions = self::groupByExhibitionYear(...$exhibitions);

        uksort($groupYearExhibitions, fn (int $a, int $b) => $b <=> $a);

        $groupExhibitions = [];

        foreach ($groupYearExhibitions as $year => $list) {
            $dto = new ArtistExhibitionGroupDto();
            $dto->year = $year === self::NULLABLE_YEAR ? null : $year;
            $dto->list = $list;

            $groupExhibitions[] = $dto;
        }

        return $groupExhibitions;
    }

    private static function groupByExhibitionYear(ArtistExhibitionDto ...$exhibitions): array
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