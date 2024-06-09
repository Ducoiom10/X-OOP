<?php

namespace Ducna\XOop\Models;

use Ducna\XOop\Commons\Model;

class CartDetail extends Model 
{
    protected string $tableName = 'cart_details';

    public function findByCartIDAndProductID($cartID, $productID) 
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('cart_id = :cart_id')
            ->andWhere('product_id = :product_id')
            ->setParameters(['cart_id' => $cartID, 'product_id' => $productID])
            ->fetchAssociative();
    }

    public function deleteByCartID($cartID) 
    {
        return $this->queryBuilder
            ->delete($this->tableName)
            ->where('cart_id = :cart_id')
            ->setParameter('cart_id', $cartID)
            ->executeQuery();
    }

    public function deleteByCartIDAndProductID($cartID, $productID) 
    {
        return $this->queryBuilder
            ->delete($this->tableName)
            ->where('cart_id = :cart_id')
            ->andWhere('product_id = :product_id')
            ->setParameters(['cart_id' => $cartID, 'product_id' => $productID])
            ->executeQuery();
    }

    public function updateByCartIDAndProductID($cartID, $productID, $quantity) 
    {
        return $this->queryBuilder
            ->update($this->tableName)
            ->set('quantity', ':quantity')
            ->where('cart_id = :cart_id')
            ->andWhere('product_id = :product_id')
            ->setParameters(['quantity' => $quantity, 'cart_id' => $cartID, 'product_id' => $productID])
            ->executeQuery();
    }
}
