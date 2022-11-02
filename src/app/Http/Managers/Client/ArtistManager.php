<?php

declare(strict_types=1);

namespace App\Http\Managers\Client;

use App\Doctrine\Repositories\Data\ArtistGalleryRepository;
use App\Doctrine\Repositories\Data\ArtistExhibitionRepository;
use App\Http\Dto\Client\Artist\ExhibitionsListBoxDto;
use App\Http\Dto\Client\Artist\Params\GetExhibitionsParamsDto;
use App\Http\Transformers\Client\Artist\ArtistExhibitionTransformer;
use App\Http\Transformers\Client\Artist\ArtistGalleryTransformer;

final class ArtistManager
{
    private ArtistGalleryRepository $artistGalleryRepository;
    private ArtistExhibitionRepository $artistExhibitionRepository;

    public function __construct(
        ArtistGalleryRepository $artistGalleryRepository,
        ArtistExhibitionRepository $artistExhibitionRepository
    ) {
        $this->artistGalleryRepository = $artistGalleryRepository;
        $this->artistExhibitionRepository = $artistExhibitionRepository;
    }

    public function getExhibitions(GetExhibitionsParamsDto $params): ExhibitionsListBoxDto
    {
        $exhibitions = ArtistExhibitionTransformer::createDtoListFromEntityList(
            ...$this->artistExhibitionRepository->findByArtistId($params->artistId)
        );

        $exhibitionsGroup = ArtistExhibitionTransformer::createGroupDtoEntity(...$exhibitions);

        $galleries = ArtistGalleryTransformer::createDtoListFromEntityList(
            ...$this->artistGalleryRepository->findByArtistId($params->artistId)
        );

        return new ExhibitionsListBoxDto($exhibitionsGroup, $galleries);
    }
}