@extends('layouts.app')

@section('content')
<h2>Novo Cliente</h2>
<form method="POST" action="{{ route('barbeiro.clients.store') }}">
    @csrf
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div class="form-group">
        <label for="telefone">Celular</label>
        <input type="text" name="telefone" id="telefone" required>
    </div>
    <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" name="password" id="password" required placeholder="Defina uma senha para o cliente">
    </div>
    <button type="submit" class="btn"><i class="fa fa-save"></i> Salvar</button>
    <a href="{{ route('barbeiro.clients.index') }}" class="btn">Voltar</a>
</form>
@endsection 