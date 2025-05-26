@extends('layouts.app')

@section('content')
<h2>Novo Barbeiro</h2>
<form method="POST" action="{{ route('barbers.store') }}">
    @csrf
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" required>
    </div>
    <button type="submit" class="btn"><i class="fa fa-save"></i> Salvar</button>
    <a href="{{ route('barbers.index') }}" class="btn">Voltar</a>
</form>
@endsection 