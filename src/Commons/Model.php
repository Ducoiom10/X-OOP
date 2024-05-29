<?php

namespace Ducna\XOop\Commons;

class Model
{
    public function __construct(
        public $conn
    )
    {
        //Thực hiện kết nối tự động khi khởi tạo bất kì một class liên quan đến model
        //Kết nối tới database
        $this-> conn = new \PDO('mysql:host=localhost;dbname=xoop;charset=utf8', 'root', '');

    }



    public function __destruct()
    {
        //Thực hiện ngắt kết nối tự động khi khởi tạo bất kì một class liên quan đến model
        //Giải phóng bộ nhớ
        $this-> conn = null;
    }
}