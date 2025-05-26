@extends('layouts.app')

@section('content')
<h2>Novo Agendamento</h2>
<form method="POST" action="{{ Auth::user()->isCliente() ? route('cliente.procedures.store') : route('barbeiro.procedures.store') }}">
    @csrf
    <div class="form-group">
        <label for="procedure_type_id">Tipo de Procedimento</label>
        <select name="procedure_type_id" id="procedure_type_id" required onchange="updateValor()">
            <option value="">Selecione...</option>
            @foreach($procedureTypes as $type)
                <option value="{{ $type->id }}" data-valor="{{ $type->valor }}">{{ $type->nome }} ({{ $type->barber->name ?? '-' }})</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="data">Data e Hora</label>
        <input type="datetime-local" name="data" id="data" required>
    </div>
    @if(auth()->user()->isCliente())
    <div class="form-group">
        <label for="client_id">Cliente</label>
        <input type="hidden" name="client_id" id="client_id" value="{{ Auth::id() }}">
        <input type="text" value="{{ Auth::user()->name }}" disabled>
    </div>
    @else
    <div class="form-group">
        <label for="client_id">Cliente</label>
        <select name="client_id" id="client_id" required>
            <option value="">Selecione...</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->telefone }})</option>
            @endforeach
        </select>
    </div>
    @endif
    <div class="form-group">
        <label for="barber_id">Barbeiro</label>
        <select name="barber_id" id="barber_id" required>
            <option value="">Selecione...</option>
            @foreach($barbers as $barber)
                <option value="{{ $barber->id }}">{{ $barber->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="valor">Valor</label>
        <input type="number" step="0.01" name="valor" id="valor" required readonly>
    </div>
    @if(auth()->user()->isAdmin() || auth()->user()->isBarbeiro())
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" required>
            <option value="Agendado">Agendado</option>
            <option value="Concluído">Concluído</option>
            <option value="Cancelado">Cancelado</option>
        </select>
    </div>
    @else
    <input type="hidden" name="status" value="Agendado">
    @endif
    <button type="submit" class="btn"><i class="fa fa-save"></i> Salvar</button>
    <a href="{{ Auth::user()->isCliente() ? route('cliente.procedures.index') : route('barbeiro.procedures.index') }}" class="btn">Voltar</a>
</form>
<script>
function updateValor() {
    var select = document.getElementById('procedure_type_id');
    var valor = select.options[select.selectedIndex].getAttribute('data-valor');
    document.getElementById('valor').value = valor || '';
}
</script>
@endsection 