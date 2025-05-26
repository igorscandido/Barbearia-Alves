@extends('layouts.app')

@section('content')
<h2>Relatórios</h2>
<form method="GET" action="{{ route('reports.index') }}" style="margin-bottom: 1rem; display: flex; gap: 1rem; align-items: center;">
    <input type="date" name="data" value="{{ request('data') }}">
    <select name="tipo">
        <option value="">Todos os tipos</option>
        <option value="procedimentos" {{ request('tipo') == 'procedimentos' ? 'selected' : '' }}>Procedimentos</option>
        <option value="financeiro" {{ request('tipo') == 'financeiro' ? 'selected' : '' }}>Financeiro</option>
    </select>
    <button type="submit" class="btn"><i class="fa fa-search"></i> Filtrar</button>
    <a href="{{ route('reports.create') }}" class="btn"><i class="fa fa-plus"></i> Gerar Relatório</a>
</form>
<table>
    <thead>
        <tr>
            <th>Data</th>
            <th>Semana</th>
            <th>Nome</th>
            <th>Total Procedimentos</th>
            <th>Total Pagos</th>
            <th>Não Pagos</th>
            <th>Valor Total Pago</th>
            <th>Valor Médio Pago</th>
        </tr>
    </thead>
    <tbody>
        @forelse($reports as $report)
        <tr>
            <td>{{ $report->data_da ? \Carbon\Carbon::parse($report->data_da)->format('d/m/Y') : '-' }}</td>
            <td>{{ $report->semana }}</td>
            <td>{{ $report->nome }}</td>
            <td>{{ $report->total_procedimentos }}</td>
            <td>{{ $report->total_procedimentos_pagos }}</td>
            <td>{{ $report->proceds_n_pagos }}</td>
            <td>R$ {{ number_format($report->valor_total_pago, 2, ',', '.') }}</td>
            <td>R$ {{ number_format($report->valor_medio_pago, 2, ',', '.') }}</td>
        </tr>
        @empty
        <tr><td colspan="8">Nenhum relatório encontrado.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection 