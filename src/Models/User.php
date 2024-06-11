<?php

namespace Ducna\XOop\Models;

use Ducna\XOop\Commons\Model;

class User extends Model 
{
    protected string $tableName = 'users';

    public function findByEmail($email)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('email = ?')
            ->setParameter(0, $email)
            ->fetchAssociative();
    }
    public function countUsers()
{
    return $this->queryBuilder
        ->select('COUNT(*) AS count')
        ->from('users')
        ->fetchOne();
}

}