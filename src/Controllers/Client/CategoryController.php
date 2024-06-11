<?php

namespace Ducna\XOop\Controllers\Client;

use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Commons\Helper;
use Ducna\XOop\Models\Category;
use Ducna\XOop\Models\Product;

class CategoryController extends Controller
{
    private Product $product;
    private Category $category;

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
    }
    public function index()
    {

    }
    public function showProductsByCategory($id)
    {
        // Lấy danh mục theo ID
        $category = $this->category->findByCategoryId($id);

        // Helper::debug($category);
        // die();
        // Kiểm tra xem danh mục có tồn tại không
        if ($category) {
            // Lấy danh sách sản phẩm thuộc danh mục có ID tương ứng
            $products = $this->product->findByCategoryId($id);

            // Trả về view hiển thị danh sách sản phẩm theo danh mục
            return $this->renderViewClient('product.products-category', [
                'products' => $products,
                'category' => $category
            ]);
        } else {

        }
    }




}
