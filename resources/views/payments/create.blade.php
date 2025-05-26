@extends('layouts.app')

@section('content')
<h2>Novo Pagamento</h2>
<form method="POST" action="{{ route('payments.store') }}">
    @csrf
    <div class="form-group">
        <label for="procedure_id">Procedimento</label>
        <select name="procedure_id" id="procedure_id" required>
            <option value="">Selecione...</option>
            @foreach($procedures as $procedure)
                <option value="{{ $procedure->id }}">{{ $procedure->tipo }} - {{ $procedure->client->nome ?? '' }} ({{ $procedure->data ? \Carbon\Carbon::parse($procedure->data)->format('d/m/Y H:i') : '' }})</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" required>
            <option value="Pendente">Pendente</option>
            <option value="Pago">Pago</option>
            <option value="Cancelado">Cancelado</option>
        </select>
    </div>
    <div class="form-group">
        <label for="link">Link de Pagamento</label>
        <input type="text" name="link" id="link">
    </div>
    <div class="form-group">
        <label for="gerado_em">Data de Geração</label>
        <input type="datetime-local" name="gerado_em" id="gerado_em">
    </div>
    <button type="submit" class="btn"><i class="fa fa-save"></i> Salvar</button>
    <a href="{{ route('payments.index') }}" class="btn">Voltar</a>
</form>
@endsection 