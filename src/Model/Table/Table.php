<?php
namespace App\Model\Table;

use Cake\ORM\Query;

/**
 * AppTable Model
 */
class Table extends \Cake\ORM\Table
{

    public function findLatest(Query $q, array $options)
    {
        return $q->order([
            $this->aliasField('created') => 'desc'
        ]);
    }
}
