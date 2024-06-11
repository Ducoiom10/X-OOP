<?php

namespace Ducna\XOop\Commons;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;

class Model
{
    protected ?Connection $conn;
    protected QueryBuilder $queryBuilder;
    protected string $tableName;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'driver' => $_ENV['DB_DRIVER'],
        ];

        $this->conn = DriverManager::getConnection($connectionParams);
        $this->queryBuilder = $this->conn->createQueryBuilder();
    }

    // CRUD
    public function all()
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->orderBy('id', 'desc')
            ->fetchAllAssociative();
    }

    public function count()
    {
        return $this->queryBuilder
            ->select('COUNT(*) AS count')
            ->from($this->tableName)
            ->fetchOne();
    }

    public function paginate($page = 1, $perPage = 10)
    {
        $queryBuilder = clone $this->queryBuilder;

        $totalPage = ceil($this->count() / $perPage);

        $offset = $perPage * ($page - 1);

        $data = $queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->setFirstResult($offset)
            ->setMaxResults($perPage)
            ->orderBy('id', 'desc')
            ->fetchAllAssociative();

        return [$data, $totalPage];
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function findByID($id)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('id = ?')
            ->setParameter(0, $id)
            ->fetchAssociative();
    }

    public function findByProductIdAndOrderId($productId, $orderId)
{
    return $this->queryBuilder
        ->select('*')
        ->from($this->tableName)
        ->where('product_id = ?')
        ->andWhere('order_id = ?')
        ->setParameter(0, $productId)
        ->setParameter(1, $orderId)
        ->fetchAssociative();
}


    public function insert(array $data)
    {
        if (!empty($data)) {
            $query = $this->queryBuilder->insert($this->tableName);

            $index = 0;
            foreach($data as $key => $value) {
                $query->setValue($key, '?')->setParameter($index, $value);
                
                ++$index;
            }

            $query->executeQuery();

            return true;
        }
        
        return false;
    }

    public function update($id, array $data)
    {
        if (!empty($data)) {
            $query = $this->queryBuilder->update($this->tableName);

            $index = 0;
            foreach ($data as $key => $value) {
                $query->set($key, '?')->setParameter($index, $value);
                ++$index;
            }

            $query->where('id = ?')
                ->setParameter($index, $id)
                ->executeQuery();

            return true;
        }

        return false;
    }

    public function increaseViewCount($id)
    {
        // Tăng giá trị của trường 
        $this->queryBuilder
            ->update($this->tableName)
            ->set('views', 'views + 1')
            ->where('id = :id')
            ->setParameter('id', $id)
            ->executeQuery();

        return true; // Trả về true nếu tăng số lượt xem thành công
    }

    public function getMostViewedProducts($limit)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->orderBy('views', 'DESC')
            ->setMaxResults($limit)
            ->fetchAllAssociative();
    }



    public function delete($id)
    {
        return $this->queryBuilder
            ->delete($this->tableName)
            ->where('id = ?')
            ->setParameter(0, $id)
            ->executeQuery();
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}
