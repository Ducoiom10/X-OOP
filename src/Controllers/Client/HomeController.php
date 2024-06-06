<?php

namespace Ducna\XOop\Controllers\Client;

use Ducna\XOop\Commons\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->renderViewClient('home', [
        ]);
    }
}