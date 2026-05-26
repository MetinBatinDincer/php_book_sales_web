@extends('layouts.app')

@section('content')
@php($total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']))
@php($walletUsed = min((float) $user->wallet_balance, (float) $total))

<h1 class="h3 mb-4">Odeme ve Siparis</h1>
<div class="row g-4">
    <div class="col-lg-7">
        <form method="post" action="{{ route('checkout.store') }}">
            @csrf
            <label class="form-label">Teslimat Adresi</label>
            <textarea class="form-control mb-3" name="shipping_address" rows="4" required>{{ old('shipping_address', $user->address) }}</textarea>
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Kart Numarasi</label>
                    <input class="form-control" name="card_number" value="4111 1111 1111 1111" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">CVV</label>
                    <input class="form-control" name="cvv" value="123" required>
                </div>
            </div>
            <button class="btn btn-primary mt-3">Siparisi Tamamla</button>
        </form>
    </div>
    <div class="col-lg-5">
        <div class="summary-box">
            <div class="d-flex justify-content-between"><span>Sepet Toplami</span><strong>{{ money($total) }}</strong></div>
            <div class="d-flex justify-content-between"><span>Kullanilan Bakiye</span><strong>{{ money($walletUsed) }}</strong></div>
            <hr>
            <div class="d-flex justify-content-between h5"><span>Karttan Cekilecek</span><strong>{{ money($total - $walletUsed) }}</strong></div>
        </div>
    </div>
</div>
@endsection

