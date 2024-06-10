<?php
namespace Ducna\XOop\Models;

use Ducna\XOop\Commons\Model;

class OrderDetail extends Model
{
    protected string $tableName = 'order_details';

    public function __construct()
    {
        parent::__construct();
        $this->queryBuilder = $this->conn->createQueryBuilder();
    }

    public function salesByDate()
    {
        try {
            return $this->queryBuilder
                ->select('DATE(created_at) as date', 'SUM(total_price) as total_sales', 'COUNT(*) as total_orders')
                ->from($this->tableName)
                ->groupBy('DATE(created_at)')
                ->orderBy('date', 'asc')
                ->fetchAllAssociative();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function salesByMonth()
    {
        try {
            return $this->queryBuilder
                ->select('YEAR(created_at) as year', 'MONTH(created_at) as month', 'SUM(total_price) as total_sales', 'COUNT(*) as total_orders')
                ->from($this->tableName)
                ->groupBy('YEAR(created_at)', 'MONTH(created_at)')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->fetchAllAssociative();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function salesByYear()
    {
        try {
            return $this->queryBuilder
                ->select('YEAR(created_at) as year', 'SUM(total_price) as total_sales', 'COUNT(*) as total_orders')
                ->from($this->tableName)
                ->groupBy('YEAR(created_at)')
                ->orderBy('year', 'asc')
                ->fetchAllAssociative();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
