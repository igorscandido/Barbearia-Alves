@extends('layouts.app')
@section('content')
<h2>Painel do Cliente</h2>
<p>Bem-vindo, {{ Auth::user()->name }}! Você está no painel do cliente.</p>
@endsection 