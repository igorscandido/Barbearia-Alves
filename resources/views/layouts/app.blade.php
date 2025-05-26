<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbearia Alves</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #222; color: #fff; font-family: Arial, sans-serif; }
        .topbar { background: #8B0000; padding: 0.5rem 2rem; display: flex; align-items: center; justify-content: space-between; }
        .logo { height: 60px; }
        .nav { display: flex; gap: 2rem; }
        .nav a { color: #fff; text-decoration: none; font-weight: bold; }
        .nav a.active, .nav a:hover { text-decoration: underline; }
        .container { max-width: 1100px; margin: 2rem auto; background: #2d2d2d; border-radius: 8px; box-shadow: 0 2px 8px #0008; padding: 2rem; }
        .btn { background: #8B0000; color: #fff; border: none; padding: 0.5rem 1.5rem; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn:hover { background: #a30000; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.3rem; }
        input, select { width: 100%; padding: 0.5rem; border-radius: 4px; border: 1px solid #444; background: #222; color: #fff; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 0.7rem; border-bottom: 1px solid #444; }
        th { background: #8B0000; color: #fff; }
        tr:nth-child(even) { background: #232323; }
    </style>
</head>
<body>
    <div class="topbar">
        <img src="/logo-barbearia.png" alt="Barbearia Alves" class="logo">
        @if(Auth::check())
        <nav class="nav">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Início</a>
            @if(Auth::user()->isAdmin() || Auth::user()->isBarbeiro())
            <a href="/barbeiro/clients" class="{{ request()->is('barbeiro/clients*') ? 'active' : '' }}">Clientes</a>
            <a href="/barbeiro/procedures" class="{{ request()->is('barbeiro/procedures*') ? 'active' : '' }}">Agendamentos</a>
            <a href="/barbeiro/procedure-types" class="{{ request()->is('barbeiro/procedure-types*') ? 'active' : '' }}">Tipos de Procedimento</a>
            <a href="/barbeiro/reports" class="{{ request()->is('barbeiro/reports*') ? 'active' : '' }}">Relatórios</a>
            @endif
            @if(Auth::user()->isCliente())
            <a href="/cliente/procedures" class="{{ request()->is('cliente/procedures*') ? 'active' : '' }}">Agendamentos</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display:inline; margin-left:1rem;">
                @csrf
                <button type="submit" class="btn">Sair</button>
            </form>
        </nav>
        @endif
    </div>
    <div class="container">
        @if(session('success'))
            <div style="background:#4caf50;color:#fff;padding:10px 20px;border-radius:4px;margin-bottom:1rem;">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div style="background:#c0392b;color:#fff;padding:10px 20px;border-radius:4px;margin-bottom:1rem;">
                <i class="fa fa-exclamation-triangle"></i> {{ $errors->first() }}
            </div>
        @endif
        @yield('content')
    </div>
</body>
</html> 