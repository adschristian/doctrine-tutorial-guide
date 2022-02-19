<?php

use App\Product;

require_once __DIR__ . '/../bootstrap.php';

$newProductName = $argv[1];

$product = new Product($newProductName);
$entityManager->persist($product);
$entityManager->flush();

echo "Created product <id={$product->id()}>\n";
