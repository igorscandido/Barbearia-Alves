@extends('layouts.app')

@section('content')
<h2>Agendamentos</h2>
<form method="GET" action="{{ Auth::user()->isCliente() ? route('cliente.procedures.index') : route('barbeiro.procedures.index') }}" style="margin-bottom: 1rem; display: flex; gap: 1rem; align-items: center;">
    <input type="text" name="search" placeholder="Buscar agendamentos..." value="{{ request('search') }}">
    <input type="date" name="data" value="{{ request('data') }}">
    <button type="submit" class="btn"><i class="fa fa-search"></i> Buscar</button>
    @if(auth()->user()->isAdmin() || auth()->user()->isCliente())
    <a href="{{ Auth::user()->isCliente() ? route('cliente.procedures.create') : route('barbeiro.procedures.create') }}" class="btn"><i class="fa fa-plus"></i> Novo Agendamento</a>
    @endif
</form>
<table>
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Agendamento</th>
            <th>Barbeiro</th>
            <th>Data</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($procedures as $procedure)
        <tr>
            <td>{{ $procedure->client->name ?? '-' }}</td>
            <td>{{ $procedure->tipo }}</td>
            <td>{{ $procedure->barber->name ?? '-' }}</td>
            <td>{{ $procedure->data ? \Carbon\Carbon::parse($procedure->data)->format('d/m/Y H:i') : '-' }}</td>
            <td>{{ $procedure->status }}</td>
            <td>
                <a href="{{ Auth::user()->isCliente() ? route('cliente.procedures.edit', $procedure) : route('barbeiro.procedures.edit', $procedure) }}" title="Editar"><i class="fa fa-edit"></i></a>
                <form action="{{ Auth::user()->isCliente() ? route('cliente.procedures.destroy', $procedure) : route('barbeiro.procedures.destroy', $procedure) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none;border:none;color:#fff;cursor:pointer" title="Excluir"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5">Nenhum agendamento encontrado.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection 