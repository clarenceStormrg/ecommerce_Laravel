@extends('layouts.app')

@section('title', $product->name)

@section('content')

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{ $product->name }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">{{ $product->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Left Sidebar Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-sm-4 g-2">
                                    <div class="col-12">
                                        <div class="product-main no-arrow">

                                            @for ($i = 0; $i < 6; $i++)
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            data-zoom-image="{{ asset('storage/' . $product->image) }}"
                                                            class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                                                    </div>
                                                </div>
                                            @endfor

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="left-slider-image left-slider no-arrow slick-top">

                                            @for ($i = 0; $i < 6; $i++)
                                                <div>
                                                    <div class="sidebar-image">
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                                                    </div>
                                                </div>
                                            @endfor

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp">
                            <div class="right-box-contain">

                                {{-- DESCUENTO --}}
                                @if ($product->discount_price)
                                    <h6 class="offer-top">
                                        {{ round(100 - ($product->discount_price * 100) / $product->price) }}% Off
                                    </h6>
                                @endif

                                <h2 class="name">{{ $product->name }}</h2>

                                <div class="price-rating">
                                    <h3 class="theme-color price">
                                        S/ {{ number_format($product->discount_price ?? $product->price, 2) }}

                                        @if ($product->discount_price)
                                            <del class="text-content">
                                                S/ {{ number_format($product->price, 2) }}
                                            </del>

                                            <span class="offer theme-color">
                                                ({{ round(100 - ($product->discount_price * 100) / $product->price) }}%
                                                off)
                                            </span>
                                        @endif
                                    </h3>

                                    <div class="product-rating custom-rate">
                                        <ul class="rating">
                                            <li><i data-feather="star" class="fill"></i></li>
                                            <li><i data-feather="star" class="fill"></i></li>
                                            <li><i data-feather="star" class="fill"></i></li>
                                            <li><i data-feather="star" class="fill"></i></li>
                                            <li><i data-feather="star"></i></li>
                                        </ul>

                                        <span class="review">23 Customer Review</span>
                                    </div>
                                </div>

                                <div class="product-contain">
                                    <p class="w-100">{{ $product->description }}</p>
                                </div>

                                {{-- CANTIDAD + BOTON CART --}}
                                <div class="note-box product-package">
                                    <div class="cart_qty qty-box product-qty">
                                        <div class="input-group">
                                            <button type="button" class="qty-left-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>

                                            <input class="form-control input-number qty-input" id="qty-{{ $product->id }}"
                                                type="text" value="1" readonly>

                                            <button type="button" class="qty-right-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <button class="btn btn-md bg-dark cart-button text-white w-100"
                                        onclick="addToCart(
                                        {{ $product->id }},
                                         document.getElementById('qty-{{ $product->id }}').value,
                                         {{ $product->discount_price ?? $product->price }},
                                          '{{ asset('storage/' . $product->image) }}',
                                          '{{ url('/product/' . $product->id) }}'
                                          )">
                                        Add To Cart
                                    </button>
                                </div>

                                {{-- WISHLIST --}}
                                <div class="buy-box">
                                    <a href="javascript:void(0)"
                                        onclick="toggleWishlist(
                                            {{ $product->id }},
                                            {{ $product->discount_price ?? $product->price }},
                                            '{{ asset('storage/' . $product->image) }}',
                                            '{{ url('/product/' . $product->id) }}'
                                        )">
                                        <i data-feather="heart"></i>
                                        <span>Add To Wishlist</span>
                                    </a>
                                </div>

                                {{-- PAYMENT --}}
                                <div class="payment-option">
                                    <div class="product-title">
                                        <h4>Guaranteed Safe Checkout</h4>
                                    </div>
                                    <ul>
                                        <li><a href="javascript:void(0)"><img
                                                    src="{{ asset('assets/images/product/payment/1.svg') }}"
                                                    class="blur-up lazyload" alt=""></a></li>
                                        <li><a href="javascript:void(0)"><img
                                                    src="{{ asset('assets/images/product/payment/2.svg') }}"
                                                    class="blur-up lazyload" alt=""></a></li>
                                        <li><a href="javascript:void(0)"><img
                                                    src="{{ asset('assets/images/product/payment/3.svg') }}"
                                                    class="blur-up lazyload" alt=""></a></li>
                                        <li><a href="javascript:void(0)"><img
                                                    src="{{ asset('assets/images/product/payment/4.svg') }}"
                                                    class="blur-up lazyload" alt=""></a></li>
                                        <li><a href="javascript:void(0)"><img
                                                    src="{{ asset('assets/images/product/payment/5.svg') }}"
                                                    class="blur-up lazyload" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR DERECHO --}}
                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">

                        <div class="vendor-box">
                            <div class="vendor-contain">
                                <div class="vendor-name">
                                    <h5 class="fw-500">{{ $product->brand?->name ?? 'Sin marca' }}</h5>
                                </div>
                            </div>

                            <p class="vendor-detail">
                                {{ $product->brand?->description ?? 'Sin descripción' }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Product Left Sidebar End -->



    <!-- Nav Tab Section Start -->
    <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="product-section-box m-0">
                        <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab">Description</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                    type="button" role="tab">Review</button>
                            </li>
                        </ul>

                        <div class="tab-content custom-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <div class="product-description">
                                    <div class="nav-desh">

                                        @if (!empty($product->description))
                                            {!! nl2br(e($product->description)) !!}
                                        @else
                                            <p class="text-content">Este producto no tiene descripción disponible.</p>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="review" role="tabpanel">
                                <div class="review-box">
                                    <div class="row">
                                        <div class="col-xl-5">
                                            <div class="product-rating-box">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="product-main-rating">
                                                            <h2>
                                                                {{ number_format($averageRating, 2) }}
                                                                <i data-feather="star"></i>
                                                            </h2>

                                                            <h5>{{ $totalReviews }}
                                                                reseña{{ $totalReviews == 1 ? '' : 's' }}</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <ul class="product-rating-list">
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>5<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 40%;">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">2</h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>4<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 20%;">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">1</h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>3<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 0%;">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">0</h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>2<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 20%;">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">1</h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>1<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 20%;">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">1</h5>
                                                                </div>
                                                            </li>
                                                        </ul>

                                                        <div class="review-title-2">
                                                            <h4 class="fw-bold">Reseña de este producto</h4>
                                                            <p>Ayuda a otros clientes dejando tu opinión.</p>

                                                            @guest
                                                                <a href="{{ route('login') }}" class="btn">
                                                                    Inicia sesión para opinar
                                                                </a>
                                                            @else
                                                                @if (!$hasBought)
                                                                    <button class="btn" type="button" disabled>
                                                                        Debes comprar este producto para reseñarlo
                                                                    </button>
                                                                @else
                                                                    <button class="btn" type="button"
                                                                        data-bs-toggle="modal" data-bs-target="#writereview">
                                                                        {{ $userReview ? 'Editar mi reseña' : 'Escribir reseña' }}
                                                                    </button>
                                                                @endif
                                                            @endguest
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-7">
                                            <div class="review-people">
                                                <ul class="review-list">
                                                    @forelse($reviews as $review)
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text d-flex align-items-center justify-content-center"
                                                                        style="width: 50px; height: 50px; border-radius: 50%; background: #f1f1f1; font-weight: bold;">
                                                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                                                    </div>
                                                                </div>

                                                                <div class="people-comment">
                                                                    <div class="people-name">
                                                                        <a href="javascript:void(0)" class="name">
                                                                            {{ $review->user->name }}
                                                                        </a>

                                                                        <div class="date-time">
                                                                            <h6 class="text-content">
                                                                                {{ $review->created_at->format('d M Y h:i A') }}
                                                                            </h6>

                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="{{ $i <= $review->rating ? 'fill' : '' }}"></i>
                                                                                        </li>
                                                                                    @endfor
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="reply">
                                                                        <p>{{ $review->comment }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @empty
                                                        <li>
                                                            <p class="text-content">Este producto aún no tiene reseñas.</p>
                                                        </li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Nav Tab Section End -->

    <!-- Review Modal Start -->
    <div class="modal fade theme-modal question-modal" id="writereview" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5">
                        {{ $userReview ? 'Editar reseña' : 'Escribir reseña' }}
                    </h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="modal-body pt-0">

                    @auth
                        @if ($hasBought)
                            <form method="POST"
                                action="{{ $userReview ? route('reviews.update', $userReview->id) : route('reviews.store') }}">

                                @csrf

                                @if ($userReview)
                                    @method('PUT')
                                @endif

                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="product-wrapper">
                                    <div class="product-image">
                                        <img class="img-fluid" alt="{{ $product->name }}"
                                            src="{{ asset('storage/' . $product->image) }}">
                                    </div>

                                    <div class="product-content">
                                        <h5 class="name">{{ $product->name }}</h5>

                                        <div class="product-review-rating">
                                            <div class="product-rating">
                                                <h6 class="price-number">
                                                    S/ {{ number_format($product->discount_price ?? $product->price, 2) }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="review-box">
                                    <label class="form-label">Rating</label>

                                    <select name="rating" class="form-control" required>
                                        <option value="">Selecciona</option>
                                        @for ($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}"
                                                {{ $userReview?->rating == $i ? 'selected' : '' }}>
                                                {{ $i }} estrella{{ $i > 1 ? 's' : '' }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="review-box">
                                    <label for="comment" class="form-label">Comentario *</label>

                                    <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Escribe tu opinión..."
                                        required>{{ old('comment', $userReview?->comment) }}</textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-md btn-theme-outline fw-bold"
                                        data-bs-dismiss="modal">
                                        Cerrar
                                    </button>

                                    <button type="submit" class="btn btn-md fw-bold text-light theme-bg-color">
                                        {{ $userReview ? 'Actualizar reseña' : 'Guardar reseña' }}
                                    </button>
                                </div>

                            </form>
                        @else
                            <div class="alert alert-warning mt-3">
                                Debes comprar este producto antes de poder dejar una reseña.
                            </div>
                        @endif
                    @else
                        <div class="alert alert-info mt-3">
                            Debes iniciar sesión para escribir una reseña.
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>
    <!-- Review Modal End -->

    <!-- Product Section Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Productos recomendados</h2>
            </div>

            <div class="slider-6_1 img-slider slick-slider-1 arrow-slider">
                @foreach ($recommendedProducts as $item)
                    <div>
                        <div class="product-box-4 wow fadeInUp">
                            <div class="product-image">

                                <div class="label-flex">
                                    {{-- Descuento --}}
                                    @if ($item->discount_price)
                                        <div class="discount">
                                            <label>
                                                -{{ round(100 - ($item->discount_price * 100) / $item->price) }}%
                                            </label>
                                        </div>
                                    @endif

                                    {{-- Wishlist --}}
                                    <button type="button" class="btn p-0 wishlist btn-wishlist notifi-wishlist"
                                        onclick="toggleWishlist(
                                    {{ $item->id }},
                                    {{ $item->discount_price ?? $item->price }},
                                    '{{ asset('storage/' . $item->image) }}',
                                    '{{ url('/product/' . $item->id) }}'
                                )">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="{{ route('product.show', $item->id) }}">
                                    <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid"
                                        alt="{{ $item->name }}">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Vista rápida">
                                        <a href="{{ route('product.show', $item->id) }}" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal"
                                            onclick="event.preventDefault(); openQuickView({{ $item->id }})">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">

                                {{-- Categoría --}}
                                <span class="span-name">
                                    {{ $item->category->name ?? 'Sin categoría' }}
                                </span>

                                <a href="{{ route('product.show', $item->id) }}">
                                    <h5 class="name">{{ $item->name }}</h5>
                                </a>

                                {{-- Rating --}}
                                <ul class="rating">
                                    <li><i data-feather="star" class="fill"></i></li>
                                    <li><i data-feather="star" class="fill"></i></li>
                                    <li><i data-feather="star" class="fill"></i></li>
                                    <li><i data-feather="star" class="fill"></i></li>
                                    <li><i data-feather="star"></i></li>
                                </ul>

                                {{-- Precio --}}
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

                                {{-- Cantidad + carrito --}}
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>

                                            <input class="form-control input-number qty-input"
                                                id="qty-{{ $item->id }}" type="text" value="1" readonly>

                                            <div class="qty-right-plus">
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
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <div class="modal fade theme-modal view-modal" id="quickViewModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div id="quickViewContent" class="text-center p-5">
                        <h5>Cargando producto...</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
