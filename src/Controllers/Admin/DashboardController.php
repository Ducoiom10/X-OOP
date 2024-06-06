<?php

namespace Ducna\XOop\Controllers\Admin;

use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Commons\Helper;

class DashboardController extends Controller
{
    public function dashboard() {        
        $this->renderViewAdmin(__FUNCTION__);
    }
}