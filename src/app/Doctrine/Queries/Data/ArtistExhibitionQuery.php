<?php

declare(strict_types=1);

namespace App\Doctrine\Queries\Data;

use App\Modules\ORM\Entity\AbstractQuery;

class ArtistExhibitionQuery extends AbstractQuery
{
    private string $artistName = 'a';
    private string $artworkName = 'w';

    public function filterArtistId(QueryBuilder $qb, ?int $artistId): self
    {
        if ($artistId !== null) {
            $this->where($qb, 'artist', $artistId);
        }

        return $this;
    }

    public function filterArtworkId(QueryBuilder $qb, ?int $artworkId): self
    {
        if (null === $artworkId) {
            return $this;
        }

        $this->leftJoinIf($qb, 'artist', $this->artistName);
        $this->leftJoinIf($qb, "{$this->artistName}.artworks", $this->artworkName);

        $qb->andWhere($qb->expr()->eq("{$this->artworkName}.id", ':artworkId'));
        $qb->setParameter('artworkId', $artworkId);

        return $this;
    }
}