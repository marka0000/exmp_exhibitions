<?php

declare(strict_types=1);

namespace App\Doctrine\Repositories\Data;

use App\Doctrine\Entities\Data\ArtistGallery;
use App\Doctrine\Queries\Data\ArtistGalleryQuery;
use App\Modules\ORM\ServiceEntityRepository;

/**
 * @template ServiceEntityRepository<ArtistGallery>
 *
 * @psalm-method list<ArtistGallery> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @psalm-method list<ArtistGallery> findAll()
 *
 * @method ArtistGallery|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtistGallery|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtistGallery[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ArtistGallery[] findAll()
 */
class ArtistGalleryRepository extends ServiceEntityRepository
{
    private ArtistGalleryQuery $query;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtistGallery::class);

        $this->query = new ArtistGalleryQuery($this);
    }

    public function findByArtistId(int $artistId): array
    {
        $qb = $this->query->createQueryBuilder();

        $this->query->filterArtistId($qb, $artistId);

        return $qb->getQuery()->getResult();
    }
}