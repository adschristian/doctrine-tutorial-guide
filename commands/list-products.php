<?php

use App\Product;

require_once __DIR__ . '/../bootstrap.php';

$productsRepository = $entityManager->getRepository(Product::class);
/** @var Product[] */
$products = $productsRepository->findAll();

foreach ($products as $product) {
    echo sprintf("-%s\n", $product->name());
}
