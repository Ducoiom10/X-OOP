<?php

namespace Ducna\XOop\Controllers\Client;

use Doctrine\DBAL\Exception\InvalidArgumentException;
use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Models\Product;

class ProductController
{
    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
        $this->productModel = new Product();
    }


    public function detail($id)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new InvalidArgumentException('Invalid product ID.');
            }
            // Sử dụng phương thức findByID từ model Product
            $product = $this->productModel->findByID($id);

            $this->renderView('product-detail', [
                'product' => $product
            ]);
        } catch (\Exception $e) {
            $this->renderError($e->getMessage());
        }
    }

    

    // Phương thức renderView và renderError vẫn giữ nguyên không thay đổi
    private function renderView($view, $data = [])
    {
        // Implement view rendering logic here
    }

    private function renderError($message)
    {
        // Implement error rendering logic here
    }
}
