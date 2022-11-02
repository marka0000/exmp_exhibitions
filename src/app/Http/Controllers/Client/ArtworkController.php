<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\AbstractController;
use App\Http\Dto\Client\Artwork\ExhibitionsListBoxDto;
use App\Http\Managers\Client\ArtworkManager;
use App\Http\Requests\Client\Artwork\GetExhibitionsRequest;

final class ArtworkController extends AbstractController
{
    private ArtworkManager $artworkManager;

    public function __construct(ArtworkManager $artworkManager)
    {
        $this->artworkManager = $artworkManager;
    }

    /**
     * @API\Method("Выставки работы")
     * @API\Request(type=GetExhibitionsRequest::class)
     *
     * @OA\Post(path="/v1/guest/jsonrpc.artwork_getExhibitions", tags={"Guest"},
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="Выставки работы художника.",
     *      @OA\JsonContent(ref="#/components/schemas/ArtworkExhibitionsListBoxDto")
     *   )
     * )
     */
    public function getExhibitions(): ExhibitionsListBoxDto
    {
        /** @var GetExhibitionsRequest $request */
        $request = $this->makeRequest(GetExhibitionsRequest::class);

        return $this->artworkManager->getExhibitions($request->getData());
    }
}