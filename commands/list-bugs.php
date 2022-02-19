<?php

use App\Bug;

require __DIR__ . '/../bootstrap.php';

$queryBuilder = $entityManager->createQueryBuilder();
$query = $queryBuilder
    ->select('b,e,r')
    ->from('App\Bug', 'b')
    ->innerJoin('b.engineer', 'e')
    ->innerJoin('b.reporter', 'r')
    ->orderBy('b.createdAt', 'DESC')
    ->getQuery();
$query->setMaxResults(30);

/** @var Bug[] */
$bugs = $query->getResult();

foreach ($bugs as $bug) {
    echo $bug->description() . " - " . $bug->createdAt()->format('d.m.Y') . "\n";
    echo "\treported by: " . $bug->reporter()->name() . "\n";
    echo "\tassigned to: " . $bug->engineer()->name() . "\n";

    foreach ($bug->products() as $product) {
        echo "\tplatform: " . $product->name() . "\n";
    }
    echo "\n";
}
