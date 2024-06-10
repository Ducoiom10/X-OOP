@extends('layouts.master')

@section('content')
    <div class="banner text-center">
        <h1>Kết quả tìm kiếm cho từ khóa: "{{ $keyword }}"</h1>
    </div>
    <div class="container">
        @if (empty($product))
            <p>Không tìm thấy kết quả cho từ khóa: "{{ $keyword }}"</p>
        @else
            <div class="product-list">
                <div class="row">
                    @foreach ($product as $item)
                        <div class="col-md-3 mb-2 mt-2">
                            <div class="card">
                                <a href="{{ url('product/' . $item['id']) }}">
                                    <img class="card-img-top" style="max-height: 320px; min-height: 320px;" src="{{ asset($item['img_thumbnail']) }}"
                                        alt="Card image">
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a class="text text-decoration-none" href="{{ url('product/' . $item['id']) }}">
                                            {{ strlen($item['name']) > 25 ? substr($item['name'], 0, 25) . '...' : $item['name'] }}
                                        </a>
                                    </h4>
                                    @if (isset($item['price_sale']) && $item['price_sale'] < $item['price_regular'])
                                        <p class="card-text ">
                                            <span class="form-control-lg">{{ number_format($item['price_regular'] - $item['price_sale'], 0, ',', '.') }} VND </span>
                                            <br>
                                            <del class="form-control-sm m-lg-1">{{ number_format($item['price_regular'], 0, ',', '.') }} VND</del>
                                            <span class="text-danger ">SALE -{{ number_format(($item['price_sale'] / $item['price_regular']) * 100) }} %</span>
                                        </p>
                                    @else
                                        <p class="card-text">{{ number_format($item['price_regular'], 0, ',', '.') }} VND</p>
                                    @endif

                                    <a href="{{ url('cart/add') }}?quantity=1&productID={{ $item['id'] }}" class="btn btn-primary w-100">Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        
    </div>
@endsection
