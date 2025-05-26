@extends('layouts.app')
@section('content')
<h2>Painel do Barbeiro</h2>
<p>Bem-vindo, {{ Auth::user()->name }}! Você está no painel do barbeiro.</p>
@endsection 