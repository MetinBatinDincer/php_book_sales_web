@extends('layouts.app')

@section('content')
<h1 class="h3">Siparis #{{ $order->id }}</h1>
<p class="text-muted">Durum: {{ config('bookstore.order_steps.' . $order->status, $order->status) }}</p>
<div class="table-responsive">
    <table class="table">
        <thead><tr><th>Urun</th><th>Adet</th><th>Birim Fiyat</th><th>Toplam</th></tr></thead>
        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ money($item->unit_price) }}</td>
                <td>{{ money($item->unit_price * $item->quantity) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="summary-box">
    <p><strong>Teslimat Adresi:</strong> {!! nl2br(e($order->shipping_address)) !!}</p>
    <p class="mb-0">
        <strong>Toplam:</strong> {{ money($order->total_amount) }} /
        <strong>Bakiye:</strong> {{ money($order->wallet_used) }} /
        <strong>Kart:</strong> {{ money($order->card_paid) }}
    </p>
</div>
@endsection

