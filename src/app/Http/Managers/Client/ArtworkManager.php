<?php

declare(strict_types=1);

namespace App\Http\Managers\Client;

use App\Doctrine\Repositories\Data\ArtistExhibitionRepository;
use App\Doctrine\Repositories\Data\ArtworkExhibitionRepository;
use App\Http\Dto\Client\Artwork\ExhibitionsListBoxDto;
use App\Http\Dto\Client\Artwork\Params\GetExhibitionsParamsDto;
use App\Http\Transformers\Client\Artist\ArtistExhibitionTransformer;
use App\Http\Transformers\Client\Artwork\ArtworkExhibitionTransformer;

final class ArtworkManager
{
    private ArtworkExhibitionRepository $artworkExhibitionRepository;
    private ArtistExhibitionRepository $artistExhibitionRepository;

    public function __construct(
        ArtworkExhibitionRepository $artworkExhibitionRepository,
        ArtistExhibitionRepository $artistExhibitionRepository
    ) {
        $this->artworkExhibitionRepository = $artworkExhibitionRepository;
        $this->artistExhibitionRepository = $artistExhibitionRepository;
    }

    public function getExhibitions(GetExhibitionsParamsDto $params): ExhibitionsListBoxDto
    {
        $exhibitions = ArtworkExhibitionTransformer::createDtoListFromEntityList(
            ...$this->artworkExhibitionRepository->findByArtworkId($params->artworkId)
        );

        $exhibitionsGroup = ArtworkExhibitionTransformer::createGroupDtoEntity(...$exhibitions);

        if (empty($exhibitionsGroup)) {
            $exhibitions = ArtistExhibitionTransformer::createDtoListFromEntityList(
                ...$this->artistExhibitionRepository->findByArtworkId($params->artworkId)
            );

            $exhibitionsGroup = ArtistExhibitionTransformer::createGroupDtoEntity(...$exhibitions);
        }

        return new ExhibitionsListBoxDto($exhibitionsGroup);
    }
}