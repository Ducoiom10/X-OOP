@extends('layouts.master')

@section('title', 'Shop')

@section('content')
    <div class="header text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <h1 class="mb-4">Shop</h1>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="text-default text-decoration-none"
                                href="{{ url('') }}">Home
                                &nbsp; &nbsp; /</a></li>
                        <li class="list-inline-item text-primary">Shop</li>
                    </ul>
                </div>
            </div>
        </div>

        <svg class="header-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306"
                stroke-miterlimit="10" />
            <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>


        <svg class="header-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_d)">
                <path class="path"
                    d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z" />
                <path
                    d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z"
                    stroke="#040306" stroke-miterlimit="10" />
            </g>
            <defs>
                <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979" filterUnits="userSpaceOnUse"
                    color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                    <feOffset dy="4" />
                    <feGaussianBlur stdDeviation="2" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
                </filter>
            </defs>
        </svg>


        <svg class="header-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306"
                stroke-miterlimit="10" />
            <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>


        <svg class="header-border" height="240" viewBox="0 0 2202 240" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
                stroke-width="2" />
        </svg>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-2 mt-2">
                    <div class="card">
                        <a href="{{ url('products/' . $product['id']) }}">
                            <img class="card-img-top" style="max-height: 320px; min-height: 320px;" src="{{ asset($product['img_thumbnail']) }}"
                                alt="Card image">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title text-[36px]" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <a class="text text-decoration-none" href="{{ url('products/' . $product['id']) }}">
                                    {{ $product['name'] }}
                                </a>
                            </h4>
                            
                            @if (isset($product['price_sale']) && $product['price_sale'] < $product['price_regular'])
                                <p class="card-text ">
                                    <span class="form-control-lg">{{ number_format($product['price_regular'] - $product['price_sale'], 0, ',', '.') }}
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

        <div class="row">
            <ul class="pagination">
                @php
                    $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? min($_GET['page'], $totalPage) : 1;
                @endphp
        
                {{-- Nút "<<" để quay lại trang trước --}}
                <li class="{{ $currentPage <= 1 ? 'disabled' : '' }}">
                    <a class="btn" href="{{ $currentPage > 1 ? url('shop') . '?page=' . ($currentPage - 1) : url('shop') }}"><<</a>
                </li>
        
                {{-- Hiển thị các trang --}}
                @for ($i = 1; $i <= $totalPage; $i++)
                    <li class="bg-gradient{{ $currentPage == $i ? ' active' : '' }}">
                        <a class="btn" href="{{ url('shop') }}?page={{ $i }}">{{ $i }}</a>
                    </li>
                @endfor
        
                {{-- Nút ">>" để đi tới trang kế tiếp --}}
                <li class="{{ $currentPage >= $totalPage ? 'disabled' : '' }}">
                    <a class="btn" href="{{ $currentPage < $totalPage ? url('shop') . '?page=' . ($currentPage + 1) : url('shop') . '?page=' . $totalPage }}">>></a>
                </li>
            </ul>
        </div>
        
        
        


    </div>
@endsection
