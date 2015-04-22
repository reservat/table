<?php

namespace Reservat\Manager;

use Reservat\Core\Interfaces\ManagerInterface;
use Reservat\Repository\TableRepository;
use Reservat\Datamapper\TableDatamapper;
use Reservat\Table;

class TableManager implements ManagerInterface
{
    public function __construct($di)
    {
        $this->repository = new TableRepository($di->get('db'));
        $this->datamapper = new TableDatamapper($di->get('db'));
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function getDatamapper()
    {
        return $this->datamapper;
    }

    public function getEntity(...$args)
    {
        return new Table(...$args);
    }
}
