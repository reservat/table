<?php

namespace Reservat\Datamapper;

use Reservat\Core\Datamapper\PDODatamapper;
use Reservat\Core\Interfaces\SQLDatamapperInterface;

class TableDatamapper extends PDODatamapper implements SQLDatamapperInterface
{
    public function table()
    {
        return 'venue_table';
    }
}
