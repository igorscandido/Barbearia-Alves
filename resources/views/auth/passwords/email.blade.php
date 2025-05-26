@extends('layouts.app')

@section('content')
<div style="max-width:400px;margin:40px auto;background:#232323;padding:2rem 2.5rem;border-radius:8px;box-shadow:0 2px 8px #0008;">
    <h2 style="text-align:center;margin-bottom:1.5rem;">Recuperar senha</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">E-mail cadastrado</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Digite seu e-mail">
        </div>
        <button type="submit" class="btn" style="width:100%;margin-bottom:1rem;">Enviar link de recuperação</button>
        <div style="text-align:center;">
            <a href="{{ route('login') }}" style="color:#fff;text-decoration:underline;">Voltar para o login</a>
        </div>
    </form>
</div>
@endsection
