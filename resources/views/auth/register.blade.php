@extends('layouts.app')

@section('content')
<div class="auth-panel mx-auto">
    <h1 class="h3 mb-3">Kayit Ol</h1>
    <form method="post" action="{{ route('register.store') }}">
        @csrf
        <label class="form-label">Ad Soyad</label>
        <input class="form-control mb-3" name="name" value="{{ old('name') }}" required>
        <label class="form-label">E-posta</label>
        <input class="form-control mb-3" type="email" name="email" value="{{ old('email') }}" required>
        <label class="form-label">Adres</label>
        <textarea class="form-control mb-3" name="address" rows="3">{{ old('address') }}</textarea>
        <label class="form-label">Sifre</label>
        <input class="form-control mb-3" type="password" name="password" minlength="6" required>
        <button class="btn btn-primary w-100">Hesap Olustur</button>
    </form>
</div>
@endsection

