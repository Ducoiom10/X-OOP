<?php
// HTTP method: GET, POST, DELETE, OPTIONS, HEAD

// use Doctrine\DBAL\Schema\Index;
use Ducna\XOop\Controllers\Client\AboutController;
use Ducna\XOop\Controllers\Client\ContactController;
use Ducna\XOop\Controllers\Client\HomeController;
use Ducna\XOop\Controllers\Client\ProductController;

$router->get(
    '/',
    HomeController::class . '@Index'
);

$router->get(
    '/about',
    AboutController::class . '@Index'
);

$router->post(
    '/contact/store',
    ContactController::class . '@Store'
);

$router->get(
    '/products',
    ProductController::class . '@Index'
);

$router->get(
    '/products/{id}',
    ProductController::class . '@Detail'
);


// website có các trang sau
// Trang chủ
// Giới thiệu
// Sản phẩm
// Chi tiết sản phẩm
// Liên hệ

// B1: Tạo controller 
// B2: Triển khai function tương ứng với các trang
// B3: Định nghĩa đường dẫn