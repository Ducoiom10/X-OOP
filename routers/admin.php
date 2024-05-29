<?php
use Doctrine\DBAL\Schema\Index;
use Ducna\XOop\Controllers\Admin\UserController ;

$router->mount('/admin', function ()  use ($router){
    // CRUD USERS
    //mount('Tiền tố', function dạng không tên );
    //->function callable
    $router->mount('/users', function ()  use ($router){
        $router->get('/'         , UserController::class . '@index');
        $router->get('/create'   , UserController::class . '@create');
        $router->post('/store'   , UserController::class . '@store');
        $router->get('/{id}'     , UserController::class . '@show');
        $router->get('/{id}/edit', UserController::class . '@edit');
        $router->put('/{id}'     , UserController::class . '@update');
        $router->delete('/{id}'  , UserController::class . '@delete');
    });
    
});



// CRUD bao gồm: Danh sách, thêm, sửa, xem, xóa
// User:
//      GET    -> USER/INDEX   -> INDEX        -> Danh sách
//      GET    -> USER/CREATE  -> CREATE       -> Hiển thị form thêm mới
//      POST   -> USER/STORE   -> STORE        -> Lưu trữ dữ liêu từ form
//      
//      PUT    -> USER/ID      -> SHOW ($id)   -> Xem chi tiết
//      GET    -> USER/ID/EDIT -> EDIT ($id)   -> Hiển thị form cập nhật
//      PUT    -> USER/ID      -> UPDATE ($id) -> Lưu dữ liệu từ form vào DB
//      DELETE -> USER/ID      -> DELETE ($id) -> Xóa bản ghi trong DB