@extends('layouts.master')

@section('content')
    <div class="banner text-center">
        <h1>Kết quả tìm kiếm cho từ khóa: "{{ $keyword }}"</h1>
    </div>
    <div class="container">
        @if (!$product)
            <p>Kết quả tìm kiếm cho từ khóa: "{{ $keyword }}"</p>
        @else
            <div class="product-list">
                <div class="row">
                    @foreach ($product as $product)
                        <div class="col-md-3 mb-2 mt-2">
                            <div class="card">
                                <a href="{{ url('product/' . $product['id']) }}">
                                    <img class="card-img-top" style="max-height: 330px" src="{{ asset($product['img_thumbnail']) }}"
                                        alt="Card image">
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a class="text text-decoration-none" href="{{ url('product/' . $product['id']) }}">
                                            {{ substr($product['name'], 0, 18) }}{{ strlen($product['name']) > 30 ? '...' : '' }}
                                        </a>
                                    </h4>
                                    @if (isset($product['price_sale']) && $product['price_sale'] < $product['price_regular'])
                                        <p class="card-text ">
                                            <span
                                                class="form-control-lg">{{ number_format($product['price_regular'] - $product['price_sale'], 0, ',', '.') }}
                                                VND </span>
                                            <br>
                                            <del class="form-control-sm m-lg-1">{{ number_format($product['price_regular'], 0, ',', '.') }}
                                                VND</del>
                                            <span class="text-danger ">SALE
                                                -{{ number_format(($product['price_sale'] / $product['price_regular']) * 100) }} %
                                            </span>
                                        </p>
                                    @else
                                        <p class="card-text">{{ number_format($product['price_regular'], 0, ',', '.') }} VND</p>
                                    @endif
        
                                    <a href="{{ url('cart/add') }}?quantity=1&productID={{ $product['id'] }}"
                                        class="btn btn-primary w-100">Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        @endif
    </div>
@endsection
