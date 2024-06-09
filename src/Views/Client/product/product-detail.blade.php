@extends('layouts.master')

@section('title', 'Chi tiết sản phẩm')
    
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-2 mt-2">
                <div class="card">
                    <img class="card-img-top" style="max-height: 350px" src="{{ asset($product['img_thumbnail'] ?? '') }}" alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product['name'] ?? '' }}</h4>
                        @if(isset($product['price_sale']) && $product['price_sale'] < $product['price_regular'])
                            <p class="card-text">
                                <span class="form-control-lg">{{ number_format($product['price_regular'] - $product['price_sale'], 0, ',', '.') }} VND </span>
                                <br> 
                                <del class="form-control-sm m-lg-1">{{ number_format($product['price_regular'], 0, ',', '.') }} VND</del>
                                <span class="text-danger ">SALE -{{ number_format(($product['price_sale']/$product['price_regular'])*100) }} % </span>
                            </p>
                        @else
                            <p class="card-text">{{ number_format($product['price_regular'] ?? 0, 0, ',', '.') }} VND</p>
                        @endif
                        <form action="{{ url('cart/add') }}" method="get">
                            <input type="hidden" name="productID" value="{{ $product['id'] ?? '' }}">
                            <input type="number" min="1" name="quantity" value="1">
                            <button type="submit">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-2 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product['name'] ?? '' }}</h4>
                        <p class="card-text">{{ $product['overview'] ?? '' }}</p>
                        <div>{!! $product['content'] ?? '' !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
