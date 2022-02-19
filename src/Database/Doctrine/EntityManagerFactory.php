<?php

declare(strict_types=1);

namespace App\Database\Doctrine;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    private EntityManagerConfig $config;

    public function __construct(EntityManagerConfig $config)
    {
        $this->config = $config;
    }

    public function getEntityManager(): EntityManagerInterface
    {
        $entityManager = EntityManager::create(
            $this->config->connection,
            $this->getConfiguration()
        );

        return $entityManager;
    }

    private function getConfiguration(): Configuration
    {
        $config = Setup::createXMLMetadataConfiguration(
            $this->config->paths,
            $this->config->isDevMode,
        );

        return $config;
    }
}
