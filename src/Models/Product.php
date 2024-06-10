<?php

namespace Ducna\XOop\Models;

use Ducna\XOop\Commons\Model;

class Product extends Model
{
    protected string $tableName = 'products';
    
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
