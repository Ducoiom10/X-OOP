<?php

// Website có các trang là:
//      Trang chủ
//      Giới thiệu
//      Sản phẩm
//      Chi tiết sản phẩm
//      Liên hệ

// Để định nghĩa được, điều đầu tiên làm là phải tạo Controller trước
// Tiếp theo, khai function tương ứng để xử lý
// Bước cuối, định nghĩa đường dẫn

// HTTP Method: get, post, put (path), delete, option, head

use Ducna\XOop\Controllers\Client\AboutController;
use Ducna\XOop\Controllers\Client\CartController;
use Ducna\XOop\Controllers\Client\CategoryController;
use Ducna\XOop\Controllers\Client\ContactController;
use Ducna\XOop\Controllers\Client\HomeController;
use Ducna\XOop\Controllers\Client\LoginController;
use Ducna\XOop\Controllers\Client\OrderController;
use Ducna\XOop\Controllers\Client\ProductController;

$router->get( '/',                  HomeController::class       . '@index');
$router->get('/shop',               HomeController::class       . '@shop');
$router->post( '/search',           HomeController::class       . '@search');


$router->get( '/about',             AboutController::class      . '@all');

$router->get( '/contact',           ContactController::class    . '@index');
$router->post( '/contact/store',    ContactController::class    . '@store');

$router->get( '/products',          ProductController::class    . '@index');
$router->get( '/products/{id}',     ProductController::class    . '@detail');

$router->get('/category/{id}',     CategoryController::class    . '@showProductsByCategory');

$router->get( '/error',              CartController::class      . '@index');


$router->get( '/login',             LoginController::class    . '@showFormLogin');
$router->post( '/handle-login',     LoginController::class    . '@login');
$router->get( '/logout',            LoginController::class    . '@logout');

$router->get('cart/add',           CartController::class . '@add');
$router->get('cart/quantityInc',   CartController::class . '@quantityInc');
$router->get('cart/quantityDec',   CartController::class . '@quantityDec');
$router->get('cart/remove',        CartController::class . '@remove');
$router->get('cart/detail',        CartController::class . '@detail');

$router->post('order/checkout',     OrderController::class . '@checkout');