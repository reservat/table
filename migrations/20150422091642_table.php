<?php

use Phinx\Migration\AbstractMigration;

class Table extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('venue_table');
        $table
            ->addColumn('number', 'string', array('limit' => 30))
            ->addColumn('capacity', 'integer')
            ->addColumn('venue_id', 'integer')
            ->addColumn('isFixed', 'boolean')
            ->create()
        ;
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('venue_table')->drop();
    }
}
