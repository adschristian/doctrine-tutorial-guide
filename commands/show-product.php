<?php
// show-product.php <id>

use App\Product;

require_once __DIR__ . '/../bootstrap.php';

$id = $argv[1];
/** @var null|Product */
$product = $entityManager->find(Product::class, $id);

if ($product === null) {
    echo "No product found\n";
    exit(1);
}

echo sprintf("-%s\n", $product->name());
