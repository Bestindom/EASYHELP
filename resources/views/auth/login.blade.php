@extends('layouts.main')

@section('title', 'Login')


@section('contenido')
    <div class="login">
        <div class="login-title">
            <h1 class="logo"><span class="logo1">Easy</span><span class="logo2">Help</span></h1>
        </div>

        <div class="row justify-content-center login-form">
            <div class="col-md-6 login-container">
                <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'login']) }}" method="POST">
                    @csrf
                    <div class="col-md-6 form-container">
                        <div class="form row mb-3 justify-content-center">
                            <input type="text" class="form-control login-input" id="username" name="username"
                                value="{{ old('username') }}" placeholder="Introduce nombre de usuario o email" autofocus>
                        </div>

                        <div class="form row mb-3 justify-content-center">
                            <input type="password" class="form-control login-input" id="password" name="password"
                                value="{{ old('password') }}" placeholder="Contraseña">
                        </div>

                        <div class="form-check mb-3 justify-content-center">
                            <input class="form-check-input" type="checkbox" id="mantener-sesion" name="mantener_sesion">
                            <label class="form-check-label" for="mantener-sesion">
                                Mantener sesión
                            </label>
                        </div>

                        <div class="row mb-3 login-button-container">
                            <div class="col-md-6 d-flex justify-content-center login-button">
                                <img src="{{ asset('img/repartidor.png') }}">
                                <button type="submit" class="btn btn-primary login">Log In</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
