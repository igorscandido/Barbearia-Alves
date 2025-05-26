@extends('layouts.app')

@section('content')
<h2>Editar Cliente</h2>
<form method="POST" action="{{ route('barbeiro.clients.update', $client) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ $client->nome }}" required>
    </div>
    <div class="form-group">
        <label for="telefone">Celular</label>
        <input type="text" name="telefone" id="telefone" value="{{ $client->telefone }}" required>
    </div>
    <button type="submit" class="btn"><i class="fa fa-save"></i> Atualizar</button>
    <a href="{{ route('barbeiro.clients.index') }}" class="btn">Voltar</a>
</form>
@endsection 