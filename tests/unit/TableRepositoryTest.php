<?php

namespace Reservat\Test;

use \Reservat\Manager\TableManager;
use \Reservat\Table;

use Aura\Di\Container;
use Aura\Di\Factory;

class TableRepositoryTest extends \PHPUnit_Framework_TestCase
{

    protected $di = null;

    protected $manager = null;

    protected function setUp()
    {
        // Schema
        $schema =<<<SQL
        CREATE TABLE "venue_table" (
        "id" INTEGER PRIMARY KEY,
        "number" VARCHAR NOT NULL,
        "capacity" TEXT NOT NULL,
        "venue_id" INT NOT NULL,
        "isFixed" BOOLEAN NOT NULL
        );
SQL;
        
        $this->di = new Container(new Factory);

        $this->di->set('db', function () {
            return new \PDO('sqlite::memory:');
        });

        $this->di->get('db')->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->di->get('db')->exec($schema);

        // Dependencies
        $this->manager = new TableManager($this->di);
    }

    public function testGetRowCount()
    {
        $this->assertCount(0, $this->manager->getRepository());
    }

    public function testAdd()
    {
        $table = new Table('1', '4', '1', false);
        $this->manager->getDatamapper()->insert($table);
        $this->assertCount(1, $this->manager->getRepository()->getAll());
    }

    public function testUpdate()
    {
        $table = new Table('1', '4', '1', false);
        $this->manager->getDatamapper()->insert($table);

        $table->setCapacity(12);
        $this->manager->getDatamapper()->update($table, 1);

        $tableUpdated = $this->manager->getRepository()->getById(1)->getResults();
        $table = Table::createFromArray($tableUpdated);

        $this->assertEquals(12, $table->getCapacity());
    }

    public function testBadInsert()
    {
        try {
            $table = new Table(null, null, null, null);
            $this->manager->getDatamapper()->save($table);
        } catch (\Exception $e) {
            $this->assertCount(0, $this->manager->getRepository()->getAll());
        }
    }

    public function testSaveInsert()
    {
        $table = new Table('1', '4', '1', false);
        $this->manager->getDatamapper()->save($table);

        $savedTable = $this->manager->getRepository()->getById(1)->getResults();
        $table = Table::createFromArray($savedTable);

        $this->assertEquals('1', $table->getNumber());
    }

    public function testSaveUpdate()
    {
        $table = new Table('1', '4', '1', false);
        $this->manager->getDatamapper()->save($table);

        $table->setCapacity('3');
        $this->manager->getDatamapper()->save($table, 1);
        $savedTable = $this->manager->getRepository()->getById(1)->getResults();
        $table = Table::createFromArray($savedTable);

        $this->assertEquals('3', $table->getCapacity());
    }

    public function testRemove()
    {
        $table = new Table('1', '4', '1', false);
        $this->manager->getDatamapper()->insert($table);
        $this->manager->getDatamapper()->delete($table, 1);

        $this->assertCount(0, $this->manager->getRepository()->getAll());
    }
}
