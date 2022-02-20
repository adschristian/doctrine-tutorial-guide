<?php

use App\Bug;

require __DIR__ . '/../bootstrap.php';

$queryBuilder = $entityManager->createQueryBuilder();
$query = $queryBuilder
    ->select('p.id, p.name, count(b.id) as openBugs')
    ->from(Bug::class, 'b')
    ->join('b.products', 'p')
    ->andWhere("b.status = 'OPEN'")
    ->groupBy('p.id')
    ->getQuery();
$productsBugs = $query->getScalarResult();

foreach ($productsBugs as $productBug) {
    echo "{$productBug['name']} has {$productBug['openBugs']} open bugs\n";
}
