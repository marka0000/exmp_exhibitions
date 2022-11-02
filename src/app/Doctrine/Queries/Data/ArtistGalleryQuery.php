<?php

declare(strict_types=1);

namespace App\Doctrine\Queries\Data;

use App\Modules\ORM\Entity\AbstractQuery;

class ArtistGalleryQuery extends AbstractQuery
{
    public function filterArtistId(QueryBuilder $qb, ?int $artistId): self
    {
        if ($artistId !== null) {
            $this->where($qb, 'artist', $artistId);
        }

        return $this;
    }
}