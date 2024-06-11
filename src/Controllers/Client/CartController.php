<?php

namespace Ducna\XOop\Controllers\Client;

use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Commons\Helper;
use Ducna\XOop\Models\Cart;
use Ducna\XOop\Models\CartDetail;
use Ducna\XOop\Models\Product;

class CartController extends Controller
{
    private Product $product;
    private Cart $cart;
    private CartDetail $cartDetail;

    public function __construct()
    {
        $this->product = new Product();
        $this->cart = new Cart();
        $this->cartDetail = new CartDetail();
    }

    public function add()
    {
        // Thêm vào giỏ hàng
        // Lấy thông tin sản phẩm theo ID
        $productId = $_GET['productID'] ?? null;
        $quantity = $_GET['quantity'] ?? 1;

        // Kiểm tra xem productID có được cung cấp không
        if (!$productId) {
            // Nếu không có productID, chuyển hướng người dùng đến trang khác hoặc thực hiện các xử lý khác
            header('Location: ' . url('login'));
            // Cần có lệnh exit để ngăn chặn việc tiếp tục thực hiện mã
            exit('Product ID is missing');
        }

        $product = $this->product->findByID($productId);

        // Kiểm tra xem sản phẩm có tồn tại không
        if (!$product) {
            // Nếu không tìm thấy sản phẩm, bạn có thể chuyển hướng người dùng đến trang khác hoặc thực hiện các xử lý khác
            // Ví dụ: header('Location: ' . url('error'));
            // Cần có lệnh exit để ngăn chặn việc tiếp tục thực hiện mã
            exit('Product not found');
        }

        // Khởi tạo SESSION cart
        // Check n đang đang đăng nhập hay không
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        if (!isset($_SESSION[$key][$product['id']])) {
            $_SESSION[$key][$product['id']] = $product + ['quantity' => $quantity];
        } else {
            $_SESSION[$key][$product['id']]['quantity'] += $quantity;
        }

        // Tiếp tục các bước tiếp theo...

        header('Location: ' . url('cart/detail'));
        exit;
    }


    public function detail()
    { // Chi tiết giỏ hàng
        $this->renderViewClient('cart');

    }

    public function quantityInc()
    { // Tăng số lượng
        // Lấy ra dữ liệu từ cart_details để đảm bảo n có tồn tại bản ghi

        // Thay đổi trong SESSION
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }


        $_SESSION[$key][$_GET['productID']]['quantity'] += 1;

        // Thay đổi trong DB
        if (isset($_SESSION['user'])) {
            $this->cartDetail->updateByCartIDAndProductID(
                $_GET['cartID'],
                $_GET['productID'],
                $_SESSION[$key][$_GET['productID']]['quantity']
            );
        }

        header('Location: ' . url('cart/detail'));
        exit;
    }

    public function quantityDec()
    { // giảm số lượng
        // Lấy ra dữ liệu từ cart_details để đảm bảo n có tồn tại bản ghi

        // Thay đổi trong SESSION
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        if ($_SESSION[$key][$_GET['productID']]['quantity'] > 1) {
            $_SESSION[$key][$_GET['productID']]['quantity'] -= 1;
        }

        // Thay đổi trong DB
        if (isset($_SESSION['user'])) {
            $this->cartDetail->updateByCartIDAndProductID(
                $_GET['cartID'],
                $_GET['productID'],
                $_SESSION[$key][$_GET['productID']]['quantity']
            );
        }

        header('Location: ' . url('cart/detail'));
        exit;
    }

    public function remove()
    {
        // Kiểm tra xem có người dùng đăng nhập không
        if (isset($_SESSION['user'])) {
            $key = 'cart-' . $_SESSION['user']['id'];

            // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
            if (isset($_SESSION[$key][$_GET['productID']])) {

                // var_dump($_SESSION[$key][$_GET['productID']]);
                // die();
                // Xóa sản phẩm khỏi giỏ hàng trong session
                unset($_SESSION[$key][$_GET['productID']]);

                // Kiểm tra và xóa sản phẩm khỏi cơ sở dữ liệu
                $this->cartDetail->deleteByCartIDAndProductID($_GET['cartID'], $_GET['productID']);

            }
        }

        // Chuyển hướng trở lại trang chi tiết giỏ hàng
        header('Location: ' . url('cart/detail'));
        exit;
    }

}