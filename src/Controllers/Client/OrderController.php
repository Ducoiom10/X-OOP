<?php

namespace Ducna\XOop\Controllers\Client;

use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Models\Cart;
use Ducna\XOop\Models\CartDetail;
use Ducna\XOop\Models\Order;
use Ducna\XOop\Models\OrderDetail;
use Ducna\XOop\Models\User;

class OrderController extends Controller
{    
    public User $user;
    public Order $order;
    public OrderDetail $orderDetail;
    private Cart $cart;
    private CartDetail $cartDetail;

    public function __construct()
    {
        $this->user         = new User();
        $this->order        = new Order();
        $this->orderDetail  = new OrderDetail();
        $this->cart         = new Cart();
        $this->cartDetail   = new CartDetail();
    }

    public function checkout() {
        try {
            // Kiểm tra xem người dùng đã đăng nhập hay chưa
            $userID = $_SESSION['user']['id'] ?? null;
    
            if (!$userID) {
                // Nếu người dùng chưa đăng nhập, tạo một người dùng mới
                $userID = $this->createNewUser();
            }
    
            // Tạo một đơn hàng mới
            $orderID = $this->createNewOrder($userID);
    
            // Thêm chi tiết đơn hàng vào bảng order_detail từ giỏ hàng
            $this->addOrderDetails($orderID);
    
            // Xóa dữ liệu trong giỏ hàng sau khi thanh toán
            $this->clearCart();
    
            // Chuyển hướng về trang chủ sau khi thanh toán thành công
            header('Location: ' . url(''));
            exit;
        } catch (\Exception $e) {
            // Xử lý các ngoại lệ có thể xảy ra trong quá trình thanh toán
            echo "Đã xảy ra lỗi trong quá trình thanh toán: " . $e->getMessage();
            // Bạn cũng có thể chuyển hướng người dùng đến một trang lỗi
            // header('Location: ' . url('error'));
            exit;
        }
    }
    
    private function addOrderDetails($orderID) {
        // Lấy dữ liệu giỏ hàng từ phiên
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }
    
        // Lặp qua các mục trong giỏ hàng và thêm chi tiết đơn hàng vào bảng order_detail
        foreach ($_SESSION[$key] as $productID => $item) {
            $this->orderDetail->insert([
                'order_id' => $orderID,
                'product_id' => $productID,
                'quantity' => $item['quantity'],
                'price_regular' => $item['price_regular'],
                'price_sale' => $item['price_sale'], // Cập nhật nếu có thông tin giá giảm giá
            ]);
        }
    }
    
    private function createNewUser() {
        // Băm mật khẩu người dùng
        $password = password_hash($_POST['user_email'], PASSWORD_DEFAULT);
        
        // Thêm dữ liệu người dùng mới vào cơ sở dữ liệu
        $this->user->insert([
            'name' => $_POST['user_name'],
            'email' => $_POST['user_email'],
            'password' => $password,
            'type' => 'member',
            'is_active' => 0,
        ]);
        
        // Trả về ID của người dùng mới tạo
        return $this->user->getConnection()->lastInsertId();
    }
    
    private function createNewOrder($userID) {
        // Thêm dữ liệu đơn hàng mới vào cơ sở dữ liệu
        $this->order->insert([
            'user_id' => $userID,
            'user_name' => $_POST['user_name'],
            'user_email' => $_POST['user_email'],
            'user_phone' => $_POST['user_phone'],
            'user_address' => $_POST['user_address'],
        ]);
        
        // Trả về ID của đơn hàng mới tạo
        return $this->order->getConnection()->lastInsertId();
    }
    
    private function clearCart() {
        // Lấy khóa phù hợp để truy cập dữ liệu giỏ hàng trong phiên
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }
    
        // Xóa dữ liệu giỏ hàng từ phiên
        unset($_SESSION[$key]);
    
        // Xóa ID giỏ hàng từ phiên nếu người dùng đã đăng nhập
        if (isset($_SESSION['user'])) {
            unset($_SESSION['cart_id']);
        }
    }
}
