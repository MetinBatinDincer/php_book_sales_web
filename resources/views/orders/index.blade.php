@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4">Siparislerim</h1>

@forelse($orders as $order)
    <div class="order-row">
        <div>
            <strong>#{{ $order->id }} - {{ money($order->total_amount) }}</strong>
            <div class="small text-muted">{{ $order->created_at->format('d.m.Y H:i') }} / {{ config('bookstore.order_steps.' . $order->status, $order->status) }}</div>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('orders.show', $order) }}">Detay</a>
            @if($order->canBeCancelledByUser())
                <form method="post" action="{{ route('orders.cancel', $order) }}" onsubmit="return confirm('Siparis iptal edilsin mi?')">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">Iptal Et</button>
                </form>
            @endif
            @if($order->canBeConfirmedByUser())
                <form method="post" action="{{ route('orders.confirm_delivery', $order) }}">
                    @csrf
                    <button class="btn btn-sm btn-success">Urunleri Teslim Aldim</button>
                </form>
            @endif
        </div>
    </div>
@empty
    <div class="alert alert-info">Henuz siparisiniz yok.</div>
@endforelse
@endsection

