<?php

use App\Bug;
use App\Enums\BugStatusEnum;

require __DIR__ . '/../bootstrap.php';

$userId = $argv[1];
$queryBuilder = $entityManager->createQueryBuilder();
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
    ->setMaxResults(15);

/** @var Bug[] */
$bugs = $query->getResult();

echo "You have created or assigned to " . count($bugs) . " open bugs:\n\n";

foreach ($bugs as $bug) {
    echo $bug->id() . " - " . $bug->description() . "\n";
}
