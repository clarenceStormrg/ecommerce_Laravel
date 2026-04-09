@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2 class="mb-2">Iniciar sesión</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Iniciar sesión</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- log in section start -->
    <section class="log-in-section background-image-2 section-b-space">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="{{ asset('assets/images/inner-page/log-in.png') }}" class="img-fluid"
                            alt="Imagen login">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3>Bienvenido a Fastkart</h3>
                            <h4>Inicia sesión en tu cuenta</h4>
                        </div>

                        {{-- Mostrar errores --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="input-box">
                            <form method="POST" action="{{ route('login') }}" class="row g-4">
                                @csrf

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Dirección de correo electrónico"
                                            required autofocus>

                                        <label for="email">Dirección de correo electrónico</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="password"
                                            name="password"
                                            placeholder="Contraseña"
                                            required>

                                        <label for="password">Contraseña</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input class="checkbox_animated check-box"
                                                type="checkbox"
                                                name="remember"
                                                id="remember">

                                            <label class="form-check-label" for="remember">
                                                Recuérdame
                                            </label>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="forgot-password">
                                                ¿Olvidaste la contraseña?
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-animation w-100 justify-content-center" type="submit">
                                        Iniciar sesión
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="other-log-in">
                            <h6>o</h6>
                        </div>

                        <div class="sign-up-box">
                            <h4>¿No tienes una cuenta?</h4>
                            <a href="{{ route('register') }}">Regístrate</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- log in section end -->
@endsection
