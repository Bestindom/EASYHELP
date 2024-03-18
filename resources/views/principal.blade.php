@extends('layouts.main')

@section('contenido')
   <p>{{ Auth::user()->admin->user_id}}</p>
@endsection
