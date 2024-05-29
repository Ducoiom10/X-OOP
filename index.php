<?php

//Chạy globle trên toàn hệ thống
session_start();

require 'vendor\autoload.php';

use Ducna\XOop\Commons\Helper;



require __DIR__ . '/routers/index.php';


Dotenv\Dotenv::createImmutable(__DIR__)->load();
// Helper::debug($_ENV);


// $array = [
//     new DOMComment(),
// ];

// Helper::debug('XXXX');