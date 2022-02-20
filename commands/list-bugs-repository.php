<?php

use App\Bug;
use App\Infra\Repository\BugRepository;

require __DIR__ . '/../bootstrap.php';

/** @var BugRepository */
$bugRepository = $entityManager->getRepository(Bug::class);
$bugs = $bugRepository->getRecentBugs();
foreach ($bugs as $bug) {
    echo $bug->description() . " - " . $bug->createdAt()->format('d.m.Y') . "\n";
    echo "\treported by: " . $bug->reporter()->name() . "\n";
    echo "\tassigned to: " . $bug->engineer()->name() . "\n";

    foreach ($bug->products() as $product) {
        echo "\tplatform: " . $product->name() . "\n";
    }
    echo "\n";
}
