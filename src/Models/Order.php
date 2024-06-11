<?php

namespace Ducna\XOop\Models;

use Ducna\XOop\Commons\Model;

class Order extends Model
{
    protected string $tableName = 'orders';
    public function countOrders()
    {
        return $this->queryBuilder
            ->select('COUNT(*) AS count')
            ->from('orders')
            ->fetchOne();
    }

}