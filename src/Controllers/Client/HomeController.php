<?php

namespace Ducna\XOop\Controllers\Client;

use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Commons\Helper;
use Ducna\XOop\Models\Category;
use Ducna\XOop\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        [$products, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);
        $categories = $this->category->all();

        // Truyền dữ liệu đã phân trang và danh mục vào view
        $this->renderViewClient(
            'home',
            [
                'products' => $products,
                'totalPage' => $totalPage,
                'categories' => $categories,
            ]
        );
    }

    public function shop()
    {
        [$products, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);

        // Truyền dữ liệu đã phân trang vào view
        $this->renderViewClient(
            'product.shop',
            [
                'products' => $products,
                'totalPage' => $totalPage,
            ]
        );
    }

    public function search()
    {
        // Lấy ra từ khóa tìm kiếm
        $keyword = $_POST['keyword'] ?? null;
        // Kiểm tra xem từ khóa tìm kiếm có tồn tại không
        if ($keyword) {
            // Sử dụng phương thức findByName từ model Product để tìm kiếm sản phẩm
            $product = (new Product())->findByName($keyword);
            // echo 1;
            // Helper::debug($product);
            // die();
            // Trả về view kết quả tìm kiếm với dữ liệu sản phẩm
            return $this->renderViewClient(
                'product.product-search',
                [
                    'product' => $product,
                    'keyword' => $keyword
                ]
            );
        } else {
            
            
        }
    }
    
}
