@extends('layouts.app')

@section('content')
<h2>Editar Pagamento</h2>
<form method="POST" action="{{ route('payments.update', $payment) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="procedure_id">Procedimento</label>
        <select name="procedure_id" id="procedure_id" required>
            <option value="">Selecione...</option>
            @foreach($procedures as $procedure)
                <option value="{{ $procedure->id }}" {{ $payment->procedure_id == $procedure->id ? 'selected' : '' }}>{{ $procedure->tipo }} - {{ $procedure->client->nome ?? '' }} ({{ $procedure->data ? \Carbon\Carbon::parse($procedure->data)->format('d/m/Y H:i') : '' }})</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" required>
            <option value="Pendente" {{ $payment->status == 'Pendente' ? 'selected' : '' }}>Pendente</option>
            <option value="Pago" {{ $payment->status == 'Pago' ? 'selected' : '' }}>Pago</option>
            <option value="Cancelado" {{ $payment->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
        </select>
    </div>
    <div class="form-group">
        <label for="link">Link de Pagamento</label>
        <input type="text" name="link" id="link" value="{{ $payment->link }}">
    </div>
    <div class="form-group">
        <label for="gerado_em">Data de Geração</label>
        <input type="datetime-local" name="gerado_em" id="gerado_em" value="{{ $payment->gerado_em ? \Carbon\Carbon::parse($payment->gerado_em)->format('Y-m-d\TH:i') : '' }}">
    </div>
    <button type="submit" class="btn"><i class="fa fa-save"></i> Atualizar</button>
    <a href="{{ route('payments.index') }}" class="btn">Voltar</a>
</form>
@endsection 