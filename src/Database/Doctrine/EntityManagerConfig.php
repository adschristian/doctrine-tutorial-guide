<?php

declare(strict_types=1);

namespace App\Database\Doctrine;

use Exception;

/**
 * @property bool $isDevMode
 * @property array $paths
 * @property array $connection
 */
class EntityManagerConfig
{
    private bool $isDevMode;
    private array $paths;
    private array $connection;

    public function __construct(
        array $connection,
        array $paths = [],
        bool $isDevMode = true,
    ) {
        $this->connection = $connection;
        $this->paths = $paths;
        $this->isDevMode = $isDevMode;
    }

    public function __get(string $name): mixed
    {
        if (!property_exists($this, $name)) {
            throw new Exception(__CLASS__ . " does not have a property called `$name`");
        }

        return $this->{$name};
    }
}
