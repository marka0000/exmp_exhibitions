<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\AbstractController;
use App\Http\Dto\Client\Artist\ExhibitionsListBoxDto;
use App\Http\Managers\Client\ArtistManager;
use App\Http\Requests\Client\Artist\GetExhibitionsRequest;

final class ArtistController extends AbstractController
{
    private ArtistManager $artistManager;

    public function __construct(ArtistManager $artistManager)
    {
        $this->artistManager = $artistManager;
    }

    /**
     * @API\Method("Выставки и галереи художника")
     * @API\Request(type=GetExhibitionsRequest::class)
     *
     * @OA\Post(path="/v1/guest/jsonrpc.artist_getExhibitions", tags={"Guest"},
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="Выставки и галереи художника",
     *     @OA\JsonContent(ref="#/components/schemas/ArtistExhibitionsListBoxDto")
     *   )
     * )
     */
    public function getExhibitions(): ExhibitionsListBoxDto
    {
        /** @var GetExhibitionsRequest $request */
        $request = $this->makeRequest(GetExhibitionsRequest::class);

        return $this->artistManager->getExhibitions($request->getData());
    }
}