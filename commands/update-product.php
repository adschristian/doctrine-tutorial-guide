<?php
// update-product.php <id> <new-name>

use App\Product;

require_once __DIR__ . '/../bootstrap.php';

$id = $argv[1];
$newName = $argv[2];

/** @var null|Product */
$product = $entityManager->find(Product::class, $id);
if ($product === null) {
    echo "Product $id does not exist.\n";
    exit(1);
}

$product->setName($newName);

$entityManager->flush();
