<?php

namespace Ducna\XOop\Models;

use Ducna\XOop\Commons\Model;

class Category extends Model
{
    protected string $tableName = 'categories';
    public function findByCategoryId($id)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('id = :id') // 
            ->setParameter('id', $id)
            ->fetchAllAssociative();
    }



    public function countCategories()
    {
        return $this->queryBuilder
            ->select('COUNT(*) AS count')
            ->from('categories')
            ->fetchOne();
    }



}