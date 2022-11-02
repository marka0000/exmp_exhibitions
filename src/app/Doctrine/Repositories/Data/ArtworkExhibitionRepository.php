<?php

declare(strict_types=1);

namespace App\Doctrine\Repositories\Data;

use App\Doctrine\Entities\Data\ArtworkExhibition;
use App\Doctrine\Queries\Data\ArtworkExhibitionQuery;
use App\Modules\ORM\ServiceEntityRepository;

/**
 * @template ServiceEntityRepository<ArtworkExhibition>
 *
 * @psalm-method list<ArtworkExhibition> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @psalm-method list<ArtworkExhibition> findAll()
 *
 * @method ArtworkExhibition|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtworkExhibition|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtworkExhibition[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ArtworkExhibition[] findAll()
 */
class ArtworkExhibitionRepository extends ServiceEntityRepository
{
    private ArtworkExhibitionQuery $query;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtworkExhibition::class);

        $this->query = new ArtworkExhibitionQuery($this);
    }

    public function findByArtworkId(int $artworkId): array
    {
        $qb = $this->query->createQueryBuilder();

        $this->query->filterArtworkId($qb, $artworkId);

        return $qb->getQuery()->getResult();
    }
}