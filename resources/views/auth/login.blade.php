@extends('layouts.app')

@section('content')
<div class="auth-panel mx-auto">
    <h1 class="h3 mb-3">Oturum Ac</h1>
    <form method="post" action="{{ route('login.store') }}">
        @csrf
        <label class="form-label">E-posta</label>
        <input class="form-control mb-3" type="email" name="email" value="{{ old('email') }}" required>
        <label class="form-label">Sifre</label>
        <input class="form-control mb-3" type="password" name="password" required>
        <button class="btn btn-primary w-100">Giris Yap</button>
    </form>
    <p class="small text-muted mt-3 mb-0">Demo admin: admin@metinkitap.test / password</p>
</div>
@endsection

