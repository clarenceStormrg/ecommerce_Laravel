@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <!-- home section start -->
    @include('partials.home')
    <!-- Home Section End -->

    <!-- Category Section Start -->
    @include('partials.category')
    <!-- Category Section End -->

    <!-- Value Section Start -->
    @include('partials.value')
    <!-- Value Section End -->

    <!-- Banner Section Start -->
    @include('partials.banner1')
    <!-- Banner Section End -->

    <!-- Banner Section Start -->
    @include('partials.banner2')
    <!-- Banner Section End -->

    <!-- Product Section Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Top Productos</h2>
            </div>

            <div class="slider-6 img-slider slick-slider-1 arrow-slider">
                @foreach ($products as $product)
                    <div>
                        <div class="product-box-4 wow fadeInUp">
                            <div class="product-image">
                                <div class="label-flex">

                                    {{-- Descuento --}}
                                    @if ($product->discount_price)
                                        <div class="discount">
                                            <label>
                                                -{{ round(100 - ($product->discount_price * 100) / $product->price) }}%
                                            </label>
                                        </div>
                                    @endif

                                    {{-- Wishlist --}}
                                    <button type="button" class="btn p-0 wishlist btn-wishlist notifi-wishlist"
                                        onclick="addToWishlist({{ $product->id }})">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="{{ url('/product/' . $product->id) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid"
                                        alt="{{ $product->name }}">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Vista rápida">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
                                <ul class="rating">
                                    <li><i data-feather="star" class="fill"></i></li>
                                    <li><i data-feather="star" class="fill"></i></li>
                                    <li><i data-feather="star" class="fill"></i></li>
                                    <li><i data-feather="star" class="fill"></i></li>
                                    <li><i data-feather="star"></i></li>
                                </ul>

                                <a href="{{ url('/product/' . $product->id) }}">
                                    <h5 class="name">{{ $product->name }}</h5>
                                </a>

                                {{-- Precio --}}
                                @if ($product->discount_price)
                                    <h5 class="price theme-color">
                                        S/ {{ number_format($product->discount_price, 2) }}
                                        <del>S/ {{ number_format($product->price, 2) }}</del>
                                    </h5>
                                @else
                                    <h5 class="price theme-color">
                                        S/ {{ number_format($product->price, 2) }}
                                    </h5>
                                @endif

                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" onclick="changeQty({{ $product->id }}, -1)">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>

                                            <input class="form-control input-number qty-input" id="qty-{{ $product->id }}"
                                                type="text" value="1" readonly>

                                            <div class="qty-right-plus" onclick="changeQty({{ $product->id }}, 1)">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="buy-button buy-button-2 btn btn-cart"
                                        onclick="addToCart({{ $product->id }})">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <script>
        function changeQty(productId, change) {
            let input = document.getElementById('qty-' + productId);
            let current = parseInt(input.value) || 1;
            let newValue = current + change;

            if (newValue < 1) newValue = 1;

            input.value = newValue;
        }

        function addToCart(productId) {
            let qty = parseInt(document.getElementById('qty-' + productId).value) || 1;

            let cart = JSON.parse(localStorage.getItem("cart")) || [];

            let existing = cart.find(item => item.product_id === productId);

            if (existing) {
                existing.quantity += qty;
            } else {
                cart.push({
                    product_id: productId,
                    quantity: qty
                });
            }

            localStorage.setItem("cart", JSON.stringify(cart));

            console.log("Producto agregado al carrito");
        }

        function addToWishlist(productId) {
            let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];

            if (!wishlist.includes(productId)) {
                wishlist.push(productId);
            }

            localStorage.setItem("wishlist", JSON.stringify(wishlist));

            console.log("Producto agregado a favoritos");
        }
    </script>

    <!-- Newsletter Section Start -->
    @include('partials.news')
    <!-- Newsletter Section End -->
@endsection
