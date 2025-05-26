@extends('layouts.app')

@section('content')
<h2>Gerar Relatório</h2>
<form method="POST" action="{{ route('reports.store') }}">
    @csrf
    <div class="form-group">
        <label for="data_da">Data</label>
        <input type="date" name="data_da" id="data_da" required>
    </div>
    <div class="form-group">
        <label for="semana">Semana</label>
        <input type="text" name="semana" id="semana" placeholder="Ex: 20/05 a 26/05" required>
    </div>
    <div class="form-group">
        <label for="nome">Nome do Relatório</label>
        <input type="text" name="nome" id="nome" required>
    </div>
    <div class="form-group">
        <label for="tipo">Tipo de Relatório</label>
        <select name="tipo" id="tipo" required>
            <option value="procedimentos">Procedimentos</option>
            <option value="financeiro">Financeiro</option>
        </select>
    </div>
    <button type="submit" class="btn"><i class="fa fa-save"></i> Gerar</button>
    <a href="{{ route('reports.index') }}" class="btn">Voltar</a>
</form>
@endsection 