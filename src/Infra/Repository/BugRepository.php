<?php

declare(strict_types=1);

namespace App\Infra\Repository;

use App\Bug;
use Doctrine\ORM\EntityRepository;

class BugRepository extends EntityRepository
{
    /**
     * @return Bug[]
     */
    public function getRecentBugs(int $number = 30): array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder
            ->select('b,e,r')
            ->from(Bug::class, 'b')
            ->join('b.engineer', 'e')
            ->join('b.reporter', 'r')
            ->orderBy('b.createdAt', 'DESC')
            ->getQuery();
        $query->setMaxResults($number);

        return $query->getResult();
    }

    public function getRecentBugsArray(int $number = 30): array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder
            ->select('b,e,r')
            ->from(Bug::class, 'b')
            ->join('b.engineer', 'e')
            ->join('b.reporter', 'r')
            ->join('b.products', 'p')
            ->orderBy('b.createdAt', 'DESC')
            ->getQuery();
        $query->setMaxResults($number);

        return $query->getArrayResult();
    }

    /**
     * @return Bug[]
     */
    public function getUserBugs(int $userId, int $number = 15): array
    {
        $queryBuilder = $this->getEntityManager->createQueryBuilder();
        $query = $queryBuilder
            ->select('b, e, r')
            ->from(Bug::class, 'b')
            ->join('b.engineer', 'e')
            ->join('b.reporter', 'r')
            ->andWhere("b.status = 'opend'")
            ->andWhere("e.id = :userId OR r.id = :userId")
            ->orderBy('b.createdAt', 'DESC')
            ->getQuery();
        $query
            ->setParameter('userId', $userId)
            ->setMaxResults($number);

        return $query->getResult;
    }

    public function getOpenBugsByProduct(): array
    {
        $queryBuilder = $this->getEntityManager->createQueryBuilder();
        $query = $queryBuilder
            ->select('p.id, p.name, count(b.id) as openBugs')
            ->from(Bug::class, 'b')
            ->join('b.products', 'p')
            ->andWhere("b.status = 'OPEN'")
            ->groupBy('p.id')
            ->getQuery();
        $productsBugs = $query->getScalarResult();

        return $productsBugs;
    }
}
