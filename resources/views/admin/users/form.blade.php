@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4">Kullanici Duzenle</h1>
<form method="post" action="{{ route('admin.users.update', $user) }}" class="row g-3">
    @csrf
    @method('put')
    <div class="col-md-6">
        <label class="form-label">Ad Soyad</label>
        <input class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">E-posta</label>
        <input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Adres</label>
        <textarea class="form-control" name="address" rows="4">{{ old('address', $user->address) }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Site Bakiyesi</label>
        <input class="form-control" type="number" step="0.01" name="wallet_balance" value="{{ old('wallet_balance', $user->wallet_balance) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Hesap Durumu</label>
        <select class="form-select" name="status">
            <option value="active" @selected(old('status', $user->status) === 'active')>Aktif</option>
            <option value="passive" @selected(old('status', $user->status) === 'passive')>Pasif</option>
        </select>
    </div>
    <div class="col-12">
        <button class="btn btn-primary">Kaydet</button>
        <a class="btn btn-outline-secondary" href="{{ route('admin.dashboard') }}">Vazgec</a>
    </div>
</form>
@endsection

