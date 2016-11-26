<?php
use Migrations\AbstractMigration;

class AddAnswersCreated extends AbstractMigration
{

    public function up()
    {

        $this->table('answers')
            ->addColumn('created', 'datetime', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('answers')
            ->removeColumn('created')
            ->removeColumn('modified')
            ->update();
    }
}

