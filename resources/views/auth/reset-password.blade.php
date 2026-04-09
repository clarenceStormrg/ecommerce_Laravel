@extends('layouts.app')

@section('title', 'Restablecer contraseña')

@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2 class="mb-2">Restablecer contraseña</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Restablecer contraseña</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Reset Password section start -->
    <section class="log-in-section section-b-space forgot-section">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="{{ asset('assets/images/inner-page/forgot.png') }}" class="img-fluid"
                            alt="Restablecer contraseña">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <div class="log-in-box">
                            <div class="log-in-title">
                                <h3>Fastkart</h3>
                                <h4>Restablece tu contraseña</h4>
                            </div>

                            <p class="text-content mt-3">
                                Ingresa tu nueva contraseña para recuperar el acceso a tu cuenta.
                            </p>

                            {{-- Mostrar errores --}}
                            @if ($errors->any())
                                <div class="alert alert-danger mt-3">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="input-box">
                                <form method="POST" action="{{ route('password.store') }}" class="row g-4">
                                    @csrf

                                    {{-- Token obligatorio --}}
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="email"
                                                name="email"
                                                value="{{ old('email', $request->email) }}"
                                                placeholder="Correo electrónico"
                                                required autofocus>

                                            <label for="email">Correo electrónico</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password"
                                                name="password"
                                                placeholder="Nueva contraseña"
                                                required>

                                            <label for="password">Nueva contraseña</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input type="password"
                                                class="form-control"
                                                id="password_confirmation"
                                                name="password_confirmation"
                                                placeholder="Confirmar contraseña"
                                                required>

                                            <label for="password_confirmation">Confirmar contraseña</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-animation w-100" type="submit">
                                            Restablecer contraseña
                                        </button>
                                    </div>

                                    <div class="col-12 text-center">
                                        <a href="{{ route('login') }}" class="text-decoration-underline">
                                            Volver al inicio de sesión
                                        </a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Reset Password section end -->
@endsection
