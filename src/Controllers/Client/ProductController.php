<?php

namespace Ducna\XOop\Controllers\Client;

use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Commons\Helper;
use Ducna\XOop\Models\Product;

class ProductController extends Controller
{
    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }
    

    public function detail($id) {
        $product = $this->product->findByID($id); 
        // Helper::debug($product);
        // die();
        $this->renderViewClient('product.product-detail', [
            'product' => $product
        ]);
        
    }

}
