<?php

namespace Ducna\XOop\Models;

use Ducna\XOop\Commons\Model;

class OrderDetail extends Model
{
    protected string $ordersTable = 'orders';
    protected string $tableName = 'order_details';

    public function __construct()
    {
        parent::__construct();
    }

    public function salesByDateMonthYear(): array
    {
        try {
            $result = $this->queryBuilder
                ->select('DATE(o.created_at) as date', 'YEAR(o.created_at) as year', 'MONTH(o.created_at) as month', 'SUM((od.price_regular - od.price_sale) * od.quantity) as total_sales', 'COUNT(DISTINCT o.id) as total_orders')
                ->from($this->tableName, 'od')
                ->innerJoin('od', $this->ordersTable, 'o', 'od.order_id = o.id')
                ->groupBy('DATE(o.created_at)', 'YEAR(o.created_at)', 'MONTH(o.created_at)')
                ->orderBy('year', 'asc')
                ->addOrderBy('month', 'asc')
                ->addOrderBy('date', 'asc')
                ->fetchAllAssociative();

            if ($result === false) {
                throw new \Exception("Failed to retrieve sales by date, month, and year.");
            }

            return $result;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function countOrderDetails(): int
    {
        return (int)$this->queryBuilder
            ->select('COUNT(*) AS count')
            ->from($this->tableName)
            ->fetchOne();
    }
}