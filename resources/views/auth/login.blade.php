@extends('layouts.main')

@section('contenido')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary text-light">
                    Login
                </div>
                <div class="card-body">
                    <form action="{{ action([App\Http\Controllers\UsuarioController::class, 'login']) }}" method="POST">
                        @csrf
                        <div class="form-floating row mb-3">                            
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" autofocus >
                            <label for="username">Username</label>
                        </div>

                        <div class="form-floating row mb-3">                            
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                            <label for="password">Password</label>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-12 d-flex flex-row-reverse">
                                <a href="{{ url('login') }}" class="btn btn-secondary float-right ms-1">Cancel</a>
                                <button type="submit" class="btn btn-primary float-right">Accept</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
