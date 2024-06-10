<?php

namespace Ducna\XOop\Controllers\Admin;

use Ducna\XOop\Commons\Controller;
use Ducna\XOop\Commons\Helper;
use Ducna\XOop\Models\OrderDetail; // Import Model Order

class DashboardController extends Controller
{
    public function dashboard()
    {
        $orderModel = new OrderDetail();
        
        // Thống kê doanh số và số lượng đơn hàng theo ngày, tháng và năm
        $salesByDate = $orderModel->salesByDate();
        $salesByMonth = $orderModel->salesByMonth();
        $salesByYear = $orderModel->salesByYear();
        helper::debug($salesByDate);
        helper::debug($salesByMonth);
        helper::debug($$salesByMonth);
        die();
        // Truyền dữ liệu vào view
        $this->renderViewAdmin('dashboard', [
            'salesByDate' => $salesByDate,
            'salesByMonth' => $salesByMonth,
            'salesByYear' => $salesByYear,
        ]);
    }
}
