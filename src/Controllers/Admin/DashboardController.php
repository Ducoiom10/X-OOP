<?php

namespace Ducna\XOop\Controllers\Admin;

use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Commons\Helper;
use Ducna\XOop\Models\OrderDetail;
use Ducna\XOop\Models\Cart;
use Ducna\XOop\Models\Category;
use Ducna\XOop\Models\Product;
use Ducna\XOop\Models\User;
use Ducna\XOop\Models\Order;


class DashboardController extends Controller
{
    private Product $product;
    private Cart $cart;
    private Category $category;
    private User $user;
    private Order $order;
    private OrderDetail $orderDetail;
    

    public function __construct()
    {
        $this->product = new Product();
        $this->cart = new Cart();
        $this->category = new Category();
        $this->user = new User();
        $this->order = new Order();
    }
    public function dashboard()
    {
        $orderDetailModel = new OrderDetail();

        // Thống kê doanh số và số lượng đơn hàng theo ngày, tháng và năm
        $salesByDateMonthYear = $orderDetailModel->salesByDateMonthYear();

        // Thống kê số lượng 
        $Cart = $this->cart->countCarts();
        $products = $this->product->countProducts();
        $categories = $this->category->countCategories();
        $users = $this->user->countUsers();
        $orders = $this->order->countOrders();

        




        // Debug dữ liệu
        
        // Helper::debug($salesByDateMonthYear);
        // die();

        // Truyền dữ liệu vào view
        $this->renderViewAdmin('dashboard', [
            'salesByDateMonthYear' => $salesByDateMonthYear,
            'Cart' => $Cart,
            'products' => $products,
            'categories' => $categories,
            'users' => $users,
            'orders' => $orders
        ]);
    }
}
