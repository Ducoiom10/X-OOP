<?php

const PATH_ROOT = __DIR__ . '/';

//Chạy globle trên toàn hệ thống
session_start();

require 'vendor\autoload.php';


Dotenv\Dotenv::createImmutable(__DIR__)->load();

require __DIR__ . '/routes/index.php';



// Helper::debug($_ENV);


// $array = [
//     new DOMComment(),
// ];

// Helper::debug('XXXX');