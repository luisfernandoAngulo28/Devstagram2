@extends('layouts.app')
@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
    <!--X es un componente-->
    <x-listar-post :posts="$posts"/>
    
@endsection
