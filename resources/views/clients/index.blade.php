@extends('layouts.app')

@section('content')
<h2>Clientes</h2>
<form method="GET" action="{{ route('barbeiro.clients.index') }}" style="margin-bottom: 1rem; display: flex; gap: 1rem; align-items: center;">
    <input type="text" name="search" placeholder="Buscar pelo nome..." value="{{ request('search') }}">
    <button type="submit" class="btn"><i class="fa fa-search"></i> Buscar</button>
    @if(auth()->user()->isAdmin())
    <a href="{{ route('barbeiro.clients.create') }}" class="btn"><i class="fa fa-plus"></i> Novo Cliente</a>
    @endif
</form>
<table>
    <thead>
        <tr>
            <th>Celular</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($clients as $client)
        <tr>
            <td>{{ $client->telefone }}</td>
            <td>{{ $client->name }}</td>
            <td>
                @if(auth()->user()->isAdmin() || auth()->user()->isBarbeiro())
                <a href="{{ route('barbeiro.clients.edit', $client) }}" title="Editar"><i class="fa fa-edit"></i></a>
                <form action="{{ route('barbeiro.clients.destroy', $client) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none;border:none;color:#fff;cursor:pointer" title="Excluir"><i class="fa fa-trash"></i></button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="3">Nenhum cliente encontrado.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection 