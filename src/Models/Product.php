<?php

namespace Ducna\XOop\Models;

use Ducna\XOop\Commons\Model;

class Product extends Model
{
    protected string $tableName = 'products';

    public function all()
    {
        return $this->queryBuilder
            ->select(
                'p.id',
                'p.category_id',
                'p.name',
                'p.img_thumbnail',
                'p.created_at',
                'p.updated_at',
                'p.price_sale',
                'p.price_regular',
                'c.name as c_name'
            )
            ->from($this->tableName, 'p')
            ->innerJoin('p', 'categories', 'c', 'c.id = p.category_id')
            ->orderBy('p.id', 'desc')
            ->fetchAllAssociative();
    }

    public function paginate($page = 1, $perPage = 10)
    {
        try {
            if (!is_numeric($page) || $page <= 0 || !is_numeric($perPage) || $perPage <= 0) {
                throw new \InvalidArgumentException('Invalid pagination parameters.');
            }

            $queryBuilder = clone ($this->queryBuilder);

            $totalPage = ceil($this->count() / $perPage);

            $offset = $perPage * ($page - 1);

            $data = $queryBuilder
                ->select(
                    'p.id',
                    'p.category_id',
                    'p.name',
                    'p.img_thumbnail',
                    'p.created_at',
                    'p.updated_at',
                    'p.price_sale',
                    'p.price_regular',
                    'c.name as c_name'
                )
                ->from($this->tableName, 'p')
                ->innerJoin('p', 'categories', 'c', 'c.id = p.category_id')
                ->setFirstResult($offset)
                ->setMaxResults($perPage)
                ->orderBy('p.id', 'desc')
                ->fetchAllAssociative();

            return [$data, $totalPage];
        } catch (\Exception $e) {
            error_log('Error occurred: ' . $e->getMessage());
            throw new \Exception('An error occurred while paginating products.');
        }
    }

    public function findByID($id)
    {
        return $this->queryBuilder
            ->select(
                'p.id',
                'p.category_id',
                'p.name',
                'p.img_thumbnail',
                'p.created_at',
                'p.updated_at',
                'p.overview',
                'p.content',
                'p.price_sale',
                'p.price_regular',
                'c.name as c_name'
            )
            ->from($this->tableName, 'p')
            ->innerJoin('p', 'categories', 'c', 'c.id = p.category_id')
            ->where('p.id = ?')
            ->setParameter(0, $id)
            ->fetchAssociative();
    }

    // Phương thức mới để tìm sản phẩm theo tên
    public function findByName($name)
{
    // Tạo câu truy vấn để lấy sản phẩm có tên chứa từ khóa $name
    $products = $this->queryBuilder
        ->select(
            'p.id',
            'p.category_id',
            'p.name',
            'p.img_thumbnail',
            'p.created_at',
            'p.updated_at',
            'p.price_sale',
            'p.price_regular',
            'c.name as c_name'
        )
        ->from($this->tableName, 'p')
        ->innerJoin('p', 'categories', 'c', 'c.id = p.category_id')
        ->where('p.name LIKE :name') // Sử dụng LIKE để tìm tất cả các sản phẩm có tên chứa từ khóa
        ->setParameter('name', '%' . $name . '%')
        ->fetchAllAssociative();

    return $products;
}


}
