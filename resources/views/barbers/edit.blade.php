@extends('layouts.app')

@section('content')
<h2>Editar Barbeiro</h2>
<form method="POST" action="{{ route('barbers.update', $barber) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ $barber->nome }}" required>
    </div>
    <button type="submit" class="btn"><i class="fa fa-save"></i> Atualizar</button>
    <a href="{{ route('barbers.index') }}" class="btn">Voltar</a>
</form>
@endsection 