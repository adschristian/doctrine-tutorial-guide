<?php

use App\Bug;

require __DIR__ . '/../bootstrap.php';

$bugId = $argv[1];

/** @var null|Bug */
$bug = $entityManager->find(Bug::class, (int) $bugId);

if (is_null($bug)) {
    echo "Bug <id=$bugId> not found";
    exit(1);
}

echo "Bug: " . $bug->description() . "\n";
echo "Engineer: " . $bug->engineer()->name() . "\n";
