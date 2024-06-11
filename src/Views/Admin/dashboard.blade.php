@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <section>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_body">
                        <div class="chart_head">
                            <div class="chart_text">
                                <h5>Users</h5>
                                <h2>{{ $users }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_body">
                        <div class="chart_head">
                            <div class="chart_text">
                                <h5>Products</h5>
                                <h2>{{ $products }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_body">
                        <div class="chart_head">
                            <div class="chart_text">
                                <h5>Categories</h5>
                                <h2>{{ $categories }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_body">
                        <div class="chart_head">
                            <div class="chart_text">
                                <h5>Orders</h5>
                                <h2>{{ $orders }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            @foreach ($salesByDateMonthYear as $data)
                <div class="col-md-4">
                    <div class="white_card mb_20">
                        <div class="white_card_body renew_report_card d-flex align-items-center justify-content-between flex-wrap">
                            <div class="renew_report_left">
                                <h4 class="f_s_19 f_w_600 color_theme2 mb-0">Sales on {{  date('d-m-Y', strtotime($data['date'])) }}</h4>
                                <p class="color_gray2 f_s_12 f_w_600">Total Sales: {{ $data['total_sales'] }} - Total Orders: {{ $data['total_orders'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
