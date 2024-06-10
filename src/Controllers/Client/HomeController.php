<?php

namespace Ducna\XOop\Controllers\Client;

use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Commons\Helper;
use Ducna\XOop\Models\Category;
use Ducna\XOop\Models\News;
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
        // Lấy danh sách sản phẩm
        [$products, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);
        
        // Danh sách sản phẩm 
        $listProduct = $this -> product ->all();

        // Lấy danh sách danh mục
        $categories = $this->category->all();
        
        // Lấy tin tức mới nhất
        $latestNews = (new News())->getLatestNews();
        $topNews = (new News())->getTopNews();
        
        // Truyền dữ liệu đã phân trang, danh mục và tin tức mới nhất vào view
        $this->renderViewClient(
            'home',
            [
                'products' => $products,
                'listProduct' => $listProduct,
                'totalPage' => $totalPage,
                'categories' => $categories,
                'latestNews' => $latestNews,
                'topNews' => $topNews 
            ]
        );
    }
    public function shop()
    {
        [$products, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);
        
        // helper::debug($products);
        // die();
        // Truyền dữ liệu đã phân trang vào view
        $this->renderViewClient(
            'product.products',
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
