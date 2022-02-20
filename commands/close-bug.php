<?php

use App\Bug;

require __DIR__ . '/../bootstrap.php';

$bugId = $argv[1];
/** @var null|Bug */
$bug = $entityManager->find(Bug::class, $bugId);
if (is_null($bug)) {
    echo "Bug <id=$bugId> not found\n";
    exit(1);
}
$bug->close();

$entityManager->flush();
