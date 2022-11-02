<?php

declare(strict_types=1);

namespace App\Doctrine\Queries\Data;

use App\Modules\ORM\Entity\AbstractQuery;

class ArtworkExhibitionQuery extends AbstractQuery
{
    public function filterArtworkId(QueryBuilder $qb, ?int $artworkId): self
    {
        if ($artworkId !== null) {
            $this->where($qb, 'artwork', $artworkId);
        }

        return $this;
    }
}