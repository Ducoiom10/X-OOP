@extends('layouts.master')

@section('content')

    @foreach ($category as $category)
        <div class="banner text-center mt-5">
            <h1>Loại: <?= $category['name'] ?></h1>
        </div>
    @endforeach

    <section class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-2 mt-2">
                    <div class="card">
                        <a href="{{ url('products/' . $product['id']) }}">
                            <img class="card-img-top" style="max-height: 320px; min-height: 320px;"
                                src="{{ asset($product['img_thumbnail']) }}" alt="Card image">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title text-[36px]"
                                style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <a class="text text-decoration-none" href="{{ url('products/' . $product['id']) }}">
                                    {{ $product['name'] }}
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
    </section>
@endsection
