<?php

declare(strict_types=1);

namespace App\Http\Requests\Client\Artwork;

use App\Http\Dto\Client\Artwork\Params\GetExhibitionsParamsDto;
use App\Modules\Core\Http\AbstractRequest;

/**
 * @method GetExhibitionsParamsDto getData()
 * @method GetExhibitionsParamsDto bind(GetExhibitionsParamsDto $dto, array $params)
 */
class GetExhibitionsRequest extends AbstractRequest
{
    protected function rules(): array
    {
        return [
            'artworkId' => ['required', 'integer'],
        ];
    }

    protected function makeDto(array $params): ?GetExhibitionsParamsDto
    {
        return $this->bind(new GetExhibitionsParamsDto(), $params);
    }
}