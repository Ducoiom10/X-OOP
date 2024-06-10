<?php

use Ducna\XOop\Controllers\Client\AboutController;
use Ducna\XOop\Controllers\Client\CartController;
use Ducna\XOop\Controllers\Client\CategoryController;
use Ducna\XOop\Controllers\Client\ContactController;
use Ducna\XOop\Controllers\Client\HomeController;
use Ducna\XOop\Controllers\Client\LoginController;
use Ducna\XOop\Controllers\Client\OrderController;
use Ducna\XOop\Controllers\Client\ProductController;

// Định nghĩa các routes
$router->get('/', HomeController::class . '@index'); // Trang chủ
$router->get('/products', HomeController::class . '@shop'); // Trang danh sách sản phẩm
$router->post('/search', HomeController::class . '@search'); // Tìm kiếm sản phẩm

$router->get('/about', AboutController::class . '@all'); // Trang giới thiệu

$router->get('/contact', ContactController::class . '@index'); // Trang liên hệ
$router->post('/contact/store', ContactController::class . '@store'); // Xử lý form liên hệ

$router->get('/products/{id}', ProductController::class . '@detail'); // Chi tiết sản phẩm

$router->get('/category/{id}', CategoryController::class . '@showProductsByCategory'); // Hiển thị sản phẩm theo danh mục

$router->get('/error', CartController::class . '@index'); // Trang lỗi

$router->get('/login', LoginController::class . '@showFormLogin'); // Form đăng nhập
$router->post('/handle-login', LoginController::class . '@login'); // Xử lý đăng nhập
$router->get('/logout', LoginController::class . '@logout'); // Đăng xuất

$router->get('/cart/add', CartController::class . '@add'); // Thêm sản phẩm vào giỏ hàng
$router->get('/cart/quantityInc', CartController::class . '@quantityInc'); // Tăng số lượng sản phẩm trong giỏ hàng
$router->get('/cart/quantityDec', CartController::class . '@quantityDec'); // Giảm số lượng sản phẩm trong giỏ hàng
$router->get('/cart/remove', CartController::class . '@remove'); // Xóa sản phẩm khỏi giỏ hàng
$router->get('/cart/detail', CartController::class . '@detail'); // Xem chi tiết giỏ hàng

$router->post('/order/checkout', OrderController::class . '@checkout'); // Xử lý đặt hàng
