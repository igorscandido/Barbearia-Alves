@extends('layouts.app')

@section('content')
<h2>Pagamentos</h2>
<form method="GET" action="{{ route('payments.index') }}" style="margin-bottom: 1rem; display: flex; gap: 1rem; align-items: center;">
    <select name="status">
        <option value="">Todos os status</option>
        <option value="Pendente" {{ request('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
        <option value="Pago" {{ request('status') == 'Pago' ? 'selected' : '' }}>Pago</option>
        <option value="Cancelado" {{ request('status') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
    </select>
    <button type="submit" class="btn"><i class="fa fa-search"></i> Filtrar</button>
    <a href="{{ route('payments.create') }}" class="btn"><i class="fa fa-plus"></i> Novo Pagamento</a>
</form>
<table>
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Procedimento</th>
            <th>Valor</th>
            <th>Status</th>
            <th>Link</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($payments as $payment)
        <tr>
            <td>{{ $payment->procedure->client->nome ?? '-' }}</td>
            <td>{{ $payment->procedure->tipo ?? '-' }}</td>
            <td>R$ {{ number_format($payment->procedure->valor ?? 0, 2, ',', '.') }}</td>
            <td>{{ $payment->status }}</td>
            <td>
                @if($payment->link)
                    <a href="{{ $payment->link }}" target="_blank">Ver Link</a>
                @else
                    -
                @endif
            </td>
            <td>
                <a href="{{ route('payments.edit', $payment) }}" title="Editar"><i class="fa fa-edit"></i></a>
                <form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none;border:none;color:#fff;cursor:pointer" title="Excluir"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6">Nenhum pagamento encontrado.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection 