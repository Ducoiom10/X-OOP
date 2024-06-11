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


    public function detail($id)
    {
        // Tăng số lượt xem cho sản phẩm
        $this->product->increaseViewCount($id);
        // Lấy thông tin sản phẩm theo ID
        $product = $this->product->findByID($id);

        // Helper::debug($product);
        // die();
        $this->renderViewClient('product.product-detail', [
            'product' => $product
        ]);

    }



}
