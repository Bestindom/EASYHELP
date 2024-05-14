@extends('layouts.main')

@section('title', 'Map')

@section('contenido')
        <div id="providers"  >
        <div>
            
        </div>
    </div>
    <div id='maps'>
        <div id="map" style="width: 100%; height: 100vh; "></div>
    </div>
@endsection

    
<style scoped>
    .navbar-expand-lg {
    height: 10vh;
     position: relative !important;
    width: 100%;
    z-index: 1000;
    background-color: #219EBC !important;
}
    .hidden {
    display: none;
}
</style>