<?php

use App\User;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/../bootstrap.php';

$newUserName = $argv[1];

$user = new User($newUserName);

$entityManager->persist($user);
$entityManager->flush();

echo "Created user <id={$user->id()}>\n";
