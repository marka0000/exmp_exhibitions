<?php

declare(strict_types=1);

namespace Tests\Feature\Client\Artwork;

use App\Doctrine\Entities\Data\Artist;
use App\Doctrine\Entities\Data\Artwork;
use App\Doctrine\Entities\Data\ArtworkExhibition;
use Tests\Feature\ClientTestCase;

final class ArtworkGetExhibitionsByIdTest extends ClientTestCase
{
    public function testSuccessful(): void
    {
        /** @var Artwork $artwork */
        $artwork = entity(Artwork::class)->create([
            'artist' => entity(Artist::class)->create(),
        ]);

        entity(ArtworkExhibition::class)->create(['artwork' => $artwork, 'year' => 2010]);
        entity(ArtworkExhibition::class, 2)->create(['artwork' => $artwork, 'year' => 2012]);
        entity(ArtworkExhibition::class)->create(['artwork' => $artwork, 'year' => null]);
        entity(ArtworkExhibition::class, 2)->create(['artwork' => $artwork, 'year' => 2015]);

        $response = $this->jsonRPC('artwork_getExhibitions', ['artworkId' => $artwork->getId()]);

        self::assertArrayHasKey('result', $response);
        self::assertIsArray($response['result']);
        self::assertArrayHasKey('exhibitions', $response['result']);
        self::assertIsArray($response['result']['exhibitions']);
        self::assertArrayHasKey('year', $response['result']['exhibitions'][0]);
        self::assertArrayHasKey('list', $response['result']['exhibitions'][0]);
        self::assertEquals(2015, $response['result']['exhibitions'][0]['year']);
        self::assertCount(2, $response['result']['exhibitions'][0]['list']);
    }

    public function testOrderByYear(): void
    {
        /** @var Artwork $artwork */
        $artwork = entity(Artwork::class)->create([
            'artist' => entity(Artist::class)->create(),
        ]);

        entity(ArtworkExhibition::class)->create(['artwork' => $artwork, 'year' => 2008]);
        entity(ArtworkExhibition::class)->create(['artwork' => $artwork, 'year' => 2012]);
        entity(ArtworkExhibition::class)->create(['artwork' => $artwork, 'year' => 2010]);


        $response = $this->jsonRPC('artwork_getExhibitions', ['artworkId' => $artwork->getId()]);

        self::assertArrayHasKey('result', $response);
        self::assertIsArray($response['result']);
        self::assertArrayHasKey('exhibitions', $response['result']);
        self::assertEquals(2012, $response['result']['exhibitions'][0]['year']);
        self::assertEquals(2010, $response['result']['exhibitions'][1]['year']);
        self::assertEquals(2008, $response['result']['exhibitions'][2]['year']);
    }
}