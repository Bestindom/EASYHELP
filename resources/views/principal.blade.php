@extends('layouts.main')

@section('contenido')
{{ Auth::user()->Admin->id }}
@endsection
