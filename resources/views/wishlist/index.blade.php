@extends('layouts.app')

@section('title', 'Wishlist')

@section('content')

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Wishlist</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Wishlist</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <!-- Wishlist Section Start -->
    <section class="wishlist-section section-b-space">
        <div class="container-fluid-lg">

            <div class="row g-sm-3 g-2">

                @foreach ($wishlists as $wishlist)
                    @php $item = $wishlist->product; @endphp

                    @if ($item)
                        <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain">

                            <div class="product-box-4 wow fadeInUp">
                                <div class="product-image">

                                    <div class="label-flex">
                                        @if ($item->discount_price)
                                            <div class="discount">
                                                <label>
                                                    -{{ round(100 - ($item->discount_price * 100) / $item->price) }}%
                                                </label>
                                            </div>
                                        @endif

                                        <button type="button"
                                            class="btn p-0 wishlist btn-wishlist notifi-wishlist wishlist-btn active"
                                            data-product-id="{{ $item->id }}">
                                            <i class="iconly-Heart icli"></i>
                                        </button>
                                    </div>

                                    <a href="{{ route('product.show', $item->id) }}">
                                        <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid"
                                            alt="{{ $item->name }}">
                                    </a>
                                </div>

                                <div class="product-detail">
                                    <span class="span-name">
                                        {{ $item->category->name ?? 'Sin categoría' }}
                                    </span>

                                    <a href="{{ route('product.show', $item->id) }}">
                                        <h5 class="name">{{ $item->name }}</h5>
                                    </a>

                                    @if ($item->discount_price)
                                        <h5 class="price theme-color">
                                            S/ {{ number_format($item->discount_price, 2) }}
                                            <del>S/ {{ number_format($item->price, 2) }}</del>
                                        </h5>
                                    @else
                                        <h5 class="price theme-color">
                                            S/ {{ number_format($item->price, 2) }}
                                        </h5>
                                    @endif

                                    <div class="price-qty">
                                        <div class="counter-number">
                                            <div class="counter">
                                                <div class="qty-left-minus" onclick="changeQty({{ $item->id }}, -1)">
                                                    <i class="fa-solid fa-minus"></i>
                                                </div>

                                                <input class="form-control input-number qty-input"
                                                    id="qty-{{ $item->id }}" type="text" value="1" readonly>

                                                <div class="qty-right-plus" onclick="changeQty({{ $item->id }}, 1)">
                                                    <i class="fa-solid fa-plus"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="buy-button buy-button-2 btn btn-cart"
                                            onclick="addToCart(
                                            {{ $item->id }},
                                            document.getElementById('qty-{{ $item->id }}').value,
                                            {{ $item->discount_price ?? $item->price }},
                                            '{{ asset('storage/' . $item->image) }}',
                                            '{{ url('/product/' . $item->id) }}'
                                        )">
                                            <i class="iconly-Buy icli text-white m-0"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @endif
                @endforeach
                <div class="col-12">
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $wishlists->links('pagination::semantic-ui') }}
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Wishlist Section End -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.wishlist-btn').forEach(button => {
                button.addEventListener('click', function() {

                    // Cambia el estado visual
                    this.classList.toggle('active');

                    // (Opcional) obtener ID del producto
                    let productId = this.dataset.productId;

                    console.log("Producto:", productId);
                });
            });
        });
    </script>
@endsection
