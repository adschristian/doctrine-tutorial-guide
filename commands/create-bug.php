<?php

// create-bug.php <reporter-id> <engineer-id> <product-ids>

use App\Bug;
use App\Product;
use App\User;

require_once __DIR__ . '/../bootstrap.php';

$reporterId = $argv[1];
$engineerId = $argv[2];
$productIds = explode(',', $argv[3]);

/** @var null|User */
$reporter = $entityManager->find(User::class, $reporterId);
/** @var null|User */
$engineer = $entityManager->find(User::class, $engineerId);

if (is_null($reporter) || is_null($engineer)) {
    echo "No reporter and/or engineer found for the given id(s)\n";
    exit(1);
}

$bug = new Bug("OPEN", "Something does not work!");

foreach ($productIds as $productId) {
    $product = $entityManager->find(Product::class, $productId);
    $bug->assignToProduct($product);
}

$bug->setReporter($reporter);
$bug->setEngineer($engineer);

$entityManager->persist($bug);
$entityManager->flush();

echo "Your new bug <id={$bug->id()}>\n";
