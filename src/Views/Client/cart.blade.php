@extends('layouts.master')

@section('title', 'Cart')

@section('content')
    <div class="container">
        <h1 class="mt-5 mb-3 text-center">Shopping Cart</h1>
        <div class="row">
            @if (!isset($_SESSION['user']))
            <span class="text-danger text-center form-control-lg">
                ! Bạn cần đăng nhập để thực hiện thanh toán
            </span>
        @endif

        @if (isset($_SESSION['user']))
            
        @endif
        </div>
        <div class="row">

            <div class="col-md-8 mb-2 mt-2">
                @if (!empty($_SESSION['cart']) || !empty($_SESSION['cart-' . $_SESSION['user']['id']]))
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cart = $_SESSION['cart'] ?? $_SESSION['cart-' . $_SESSION['user']['id']];
                            @endphp
                            @foreach ($cart as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td><img class="w-25 h-50" src="{{ asset($item['img_thumbnail']) }}" class="product-img"
                                            alt="Product Image"></td>
                                    <td>
                                        <a class="btn btn-danger"
                                            href="{{ url('cart/quantityDec') . '?productID=' . $item['id'] }}">-</a>
                                        {{ $item['quantity'] }}
                                        <a class="btn btn-primary"
                                            href="{{ url('cart/quantityInc') . '?productID=' . $item['id'] }}">+</a>
                                    </td>
                                    <td>{{ $item['price_sale'] ?: $item['price_regular'] }}</td>
                                    <td>{{ $item['quantity'] * ($item['price_sale'] ?: $item['price_regular']) }}</td>
                                    <td>
                                        <a onclick="return confirm('Are you sure?')"
                                            href="{{ url('cart/remove') . '?productID=' . $item['id'] }}">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Your cart is empty.</p>
                @endif
            </div>

            <div class="col-md-4 mb-2 mt-2">
                <h2>Checkout</h2>
                <form action="{{ url('order/checkout') }}" method="POST">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name"
                            value="{{ $_SESSION['user']['name'] ?? '' }}" placeholder="Enter name" name="user_name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email"
                            value="{{ $_SESSION['user']['email'] ?? '' }}" placeholder="Enter email"
                            name="user_email">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone:</label>
                        <input type="text" class="form-control" id="phone"
                            value="{{ $_SESSION['user']['phone'] ?? '' }}" placeholder="Enter phone"
                            name="user_phone">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="address"
                            value="{{ $_SESSION['user']['address'] ?? '' }}" placeholder="Enter address"
                            name="user_address">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
