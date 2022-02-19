<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Database\Doctrine\EntityManagerConfig;
use App\Database\Doctrine\EntityManagerFactory;

$connection = require __DIR__ . '/config/database.php';
$entityManagerFactory = new EntityManagerFactory(
    new EntityManagerConfig(
        $connection,
        [__DIR__ . '/config/xml'],
        true
    )
);
$entityManager = $entityManagerFactory->getEntityManager();
