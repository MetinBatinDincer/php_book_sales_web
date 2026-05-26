@extends('layouts.app')

@section('content')
<div class="row g-4">
    <div class="col-lg-7">
        <h1 class="h3">Profil Bilgileri</h1>
        <form method="post" action="{{ route('profile.update') }}" class="mt-3">
            @csrf
            @method('put')
            <label class="form-label">Ad Soyad</label>
            <input class="form-control mb-3" name="name" value="{{ old('name', $user->name) }}" required>
            <label class="form-label">E-posta</label>
            <input class="form-control mb-3" type="email" name="email" value="{{ old('email', $user->email) }}" required>
            <label class="form-label">Adres</label>
            <textarea class="form-control mb-3" name="address" rows="4">{{ old('address', $user->address) }}</textarea>
            <label class="form-label">Yeni Sifre</label>
            <input class="form-control mb-3" type="password" name="password" placeholder="Degistirmeyecekseniz bos birakin">
            <button class="btn btn-primary">Guncelle</button>
        </form>
    </div>
    <div class="col-lg-5">
        <div class="balance-box">
            <span class="text-muted">Site Bakiyesi</span>
            <strong>{{ money($user->wallet_balance) }}</strong>
            <p class="small mb-0">Iptal edilen onay bekleyen siparislerin tutari burada gorunur ve sonraki alisveriste once bu bakiyeden dusulur.</p>
        </div>
        @if(! $user->isAdmin())
            <form method="post" action="{{ route('profile.deactivate') }}" class="mt-3" onsubmit="return confirm('Uyelik pasif yapilsin mi?')">
                @csrf
                <button class="btn btn-outline-danger">Uyeligimi Pasif Et</button>
            </form>
        @endif
    </div>
</div>
@endsection

