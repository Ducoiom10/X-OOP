@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 text_white">Dashboard</h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Salessa </a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales</li>
                    </ol>
                </div>
                <a href="#" class="white_btn3">Create Report</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 card_height_100">
            <div class="white_card mb_20">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Revenue</h3>
                        </div>
                        <div class="float-lg-right float-none sales_renew_btns justify-content-end">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">This Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Last Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Last Month</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="white_card_body" style="height: 286px;">
                    <canvas id="bar"></canvas>
                </div>
            </div>
    
            <?php if (is_array($salesByDate) && !empty($salesByDate)): ?>
                <?php foreach ($salesByDate as $data): ?>
                    <div class="white_card mb_20">
                        <div class="white_card_body renew_report_card d-flex align-items-center justify-content-between flex-wrap">
                            <div class="renew_report_left">
                                <h4 class="f_s_19 f_w_600 color_theme2 mb-0">Sales on <?php echo $data['date']; ?></h4>
                                <p class="color_gray2 f_s_12 f_w_600">Total Sales: <?php echo $data['total_sales']; ?> - Total Orders: <?php echo $data['total_orders']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
    
            <?php if (is_array($salesByMonth) && !empty($salesByMonth)): ?>
                <?php foreach ($salesByMonth as $data): ?>
                    <div class="white_card mb_20">
                        <div class="white_card_body renew_report_card d-flex align-items-center justify-content-between flex-wrap">
                            <div class="renew_report_left">
                                <h4 class="f_s_19 f_w_600 color_theme2 mb-0">Sales in <?php echo date('F', mktime(0, 0, 0, $data['month'], 10)); ?> <?php echo $data['year']; ?></h4>
                                <p class="color_gray2 f_s_12 f_w_600">Total Sales: <?php echo $data['total_sales']; ?> - Total Orders: <?php echo $data['total_orders']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
    
            <?php if (is_array($salesByYear) && !empty($salesByYear)): ?>
                <?php foreach ($salesByYear as $data): ?>
                    <div class="white_card mb_20">
                        <div class="white_card_body renew_report_card d-flex align-items-center justify-content-between flex-wrap">
                            <div class="renew_report_left">
                                <h4 class="f_s_19 f_w_600 color_theme2 mb-0">Sales in <?php echo $data['year']; ?></h4>
                                <p class="color_gray2 f_s_12 f_w_600">Total Sales: <?php echo $data['total_sales']; ?> - Total Orders: <?php echo $data['total_orders']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    

    <div class="sales_unit_footer d-flex justify-content-between">
        <div class="single_sales">
            <p>This Month Revenue</p>
            <h3>$57k</h3>
            <p class="d-flex align-items-center"> <i class="ti-arrow-up"></i> <span> 14.5%</span>
                Up From Last Month </p>
        </div>
        <div class="single_sales disable_sales">
            <p>This Month Revenue</p>
            <h3>$14k</h3>
            <p class="d-flex align-items-center"> <i class="ti-arrow-up"></i> <span> 14.5%</span>
                Up From Last Month </p>
        </div>
    </div>
    </div>
    <div class="col-lg-4">
        <div class="white_card card_height_100 mb_20">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h3 class="m-0">Daily Sales</h3>
                    </div>
                    <div class="header_more_tool">
                        <div class="dropdown">
                            <span class="dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <i class="ti-more-alt"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#"> <i class="ti-eye"></i>
                                    Action</a>
                                <a class="dropdown-item" href="#"> <i class="ti-trash"></i>
                                    Delete</a>
                                <a class="dropdown-item" href="#"> <i class="fas fa-edit"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="#"> <i class="ti-printer"></i>
                                    Print</a>
                                <a class="dropdown-item" href="#"> <i class="fa fa-download"></i> Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <div id="chart-currently"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="white_card card_height_100 mb_20">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h3 class="m-0">Summary</h3>
                    </div>
                    <div class="header_more_tool">
                        <div class="dropdown">
                            <span class="dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <i class="ti-more-alt"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#"> <i class="ti-eye"></i>
                                    Action</a>
                                <a class="dropdown-item" href="#"> <i class="ti-trash"></i>
                                    Delete</a>
                                <a class="dropdown-item" href="#"> <i class="fas fa-edit"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="#"> <i class="ti-printer"></i>
                                    Print</a>
                                <a class="dropdown-item" href="#"> <i class="fa fa-download"></i> Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="white_card_body mt_30">
                <div id="bar1" class="barfiller">
                    <div class="tipWrap">
                        <span class="tip"></span>
                    </div>
                    <span class="fill" data-percentage="25"></span>
                </div>
                <div id="bar2" class="barfiller">
                    <div class="tipWrap">
                        <span class="tip"></span>
                    </div>
                    <span class="fill" data-percentage="75"></span>
                </div>
                <div id="bar3" class="barfiller mb-0">
                    <div class="tipWrap">
                        <span class="tip"></span>
                    </div>
                    <span class="fill" data-percentage="34"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="white_card card_height_100 mb_20">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h3 class="m-0">Total order</h3>
                    </div>
                    <div class="float-lg-right float-none sales_renew_btns justify-content-end">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Today</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">This week</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="white_card_body d-flex align-items-center" style="height:140px">
                <h4 class="f_w_900 f_s_60 mb-0 me-2">356</h4>
                <div class="w-100" style="height:100px">
                    <canvas width="100%" id="page_views"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    
    </div>
@endsection
