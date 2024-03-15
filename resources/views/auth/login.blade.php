@extends('layouts.main')

@section('title', 'Login')

@section('text')
    <h1 class="logo"><span class="logo1">Easy</span><span class="logo2">Help</span></h1>
@endsection

@section('form')
    <div class="col-md-6">
        <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'login']) }}" method="POST">
            @csrf
            <div class="form row mb-3">
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}"
                    placeholder="Introduce nombre de usuario o email" autofocus>
            </div>

            <div class="form row mb-3">
                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"
                    placeholder="Contraseña">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="mantener-sesion" name="mantener_sesion">
                <label class="form-check-label" for="mantener-sesion">
                    Mantener sesión
                </label>
            </div>


            <div class="row mb-3">
                <div class="col-sm-12 d-flex flex-row-reverse">
                    <a href="{{ url('login') }}" class="btn btn-secondary float-right ms-1">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Accept</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('background-image')
    
@endsection
