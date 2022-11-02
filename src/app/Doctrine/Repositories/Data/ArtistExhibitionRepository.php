<?php

declare(strict_types=1);

namespace App\Doctrine\Repositories\Data;

use App\Doctrine\Entities\Data\ArtistExhibition;
use App\Doctrine\Queries\Data\ArtistExhibitionQuery;
use App\Modules\ORM\ServiceEntityRepository;

/**
 * @template ServiceEntityRepository<ArtistExhibition>
 *
 * @psalm-method list<ArtistExhibition> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @psalm-method list<ArtistExhibition> findAll()
 *
 * @method ArtistExhibition|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtistExhibition|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtistExhibition[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ArtistExhibition[] findAll()
 */
class ArtistExhibitionRepository extends ServiceEntityRepository
{
    private ArtistExhibitionQuery $query;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtistExhibition::class);

        $this->query = new ArtistExhibitionQuery($this);
    }

    public function findByArtistId(int $artistId): array
    {
        $qb = $this->query->createQueryBuilder();

        $this->query->filterArtistId($qb, $artistId);

        return $qb->getQuery()->getResult();
    }
}