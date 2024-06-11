<?php

namespace Ducna\XOop\Models;

use Ducna\XOop\Commons\Model;

class News extends Model
{
    protected string $tableName = 'news';

    public function getLatestNews($limit = 1)
    {
        $queryBuilder = $this->getConnection()->createQueryBuilder();
        $queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->orderBy('created_at', 'DESC')
            ->setMaxResults($limit);

        return $queryBuilder->fetchAllAssociative();
    }

    public function getTopNews($limit = 4)
    {
        $queryBuilder = $this->getConnection()->createQueryBuilder();
        $queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->orderBy('created_at', 'DESC')
            ->setMaxResults($limit);

        return $queryBuilder->fetchAllAssociative();
    }
    public function countNews()
    {
        return $this->queryBuilder
            ->select('COUNT(*) AS count')
            ->from('news')
            ->fetchOne();
    }

}
