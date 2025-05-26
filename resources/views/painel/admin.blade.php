@extends('layouts.app')
@section('content')
<h2>Painel do Administrador</h2>
<p>Bem-vindo, {{ Auth::user()->name }}! Você está no painel de administração.</p>
@endsection 