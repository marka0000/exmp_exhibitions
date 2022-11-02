<?php

declare(strict_types=1);

namespace Tests\Feature\Client\Artist;

use App\Doctrine\Entities\Data\Artist;
use App\Doctrine\Entities\Data\ArtistExhibition;
use App\Doctrine\Entities\Data\ArtistGallery;
use Tests\Feature\ClientTestCase;

final class ArtistGetExhibitionsByIdTest extends ClientTestCase
{
    private const METHOD_NAME = 'artist_getExhibitions';

    public function testSuccessful(): void
    {
        /** @var Artist $artist */
        $artist = entity(Artist::class)->create();

        entity(ArtistExhibition::class, 2)->create(['artist' => $artist]);
        entity(ArtistGallery::class, 2)->create(['artist' => $artist]);

        $response = $this->jsonRPC(self::METHOD_NAME, ['artistId' => $artist->getId()]);

        self::assertArrayHasKey('result', $response);
        self::assertIsArray($response['result']);
        self::assertArrayHasKey('exhibitions', $response['result']);
        self::assertArrayHasKey('galleries', $response['result']);
        self::assertNotEmpty($response['result']['exhibitions']);
        self::assertNotEmpty($response['result']['galleries']);
    }

    public function testExhibitionsGroup(): void
    {
        /** @var Artist $artist */
        $artist = entity(Artist::class)->create();

        entity(ArtistExhibition::class, 2)->create(['artist' => $artist, 'year' => 2012]);
        entity(ArtistExhibition::class, 2)->create(['artist' => $artist, 'year' => 2010]);


        $response = $this->jsonRPC(self::METHOD_NAME, ['artistId' => $artist->getId()]);

        self::assertArrayHasKey('result', $response);
        self::assertIsArray($response['result']);
        self::assertArrayHasKey('exhibitions', $response['result']);
        self::assertArrayHasKey('year', $response['result']['exhibitions'][0]);
        self::assertArrayHasKey('list', $response['result']['exhibitions'][0]);
        self::assertEquals(2012, $response['result']['exhibitions'][0]['year']);
        self::assertCount(2, $response['result']['exhibitions'][0]['list']);
    }
}