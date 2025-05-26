@extends('layouts.app')

@section('content')
<h2>Editar Tipo de Procedimento</h2>
<form method="POST" action="{{ route('barbeiro.procedure-types.update', $procedureType) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ $procedureType->nome }}" required>
    </div>
    <div class="form-group">
        <label for="valor">Valor</label>
        <input type="number" step="0.01" name="valor" id="valor" value="{{ $procedureType->valor }}" required>
    </div>
    @if(auth()->user()->isAdmin())
    <div class="form-group">
        <label for="barber_id">Barbeiro</label>
        <select name="barber_id" id="barber_id" required>
            <option value="">Selecione...</option>
            @foreach($barbers as $barber)
                <option value="{{ $barber->id }}" {{ $procedureType->barber_id == $barber->id ? 'selected' : '' }}>{{ $barber->name }}</option>
            @endforeach
        </select>
    </div>
    @endif
    <button type="submit" class="btn"><i class="fa fa-save"></i> Atualizar</button>
    <a href="{{ route('barbeiro.procedure-types.index') }}" class="btn">Voltar</a>
</form>
@endsection 