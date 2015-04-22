<?php

namespace Reservat\Repository;

use Reservat\Core\Repository\PDORepository;
use Reservat\Core\Interfaces\SQLRepositoryInterface;

class TableRepository extends PDORepository implements SQLRepositoryInterface
{
    public function table()
    {
        return 'venue_table';
    }
}
