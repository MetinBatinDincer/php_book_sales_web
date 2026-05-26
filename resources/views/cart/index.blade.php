@extends('layouts.app')

@section('content')
@php($total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']))

<h1 class="h3 mb-4">Sepetim</h1>
@if($cart)
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr><th>Urun</th><th>Adet</th><th>Birim Fiyat</th><th>Toplam</th><th></th></tr>
            </thead>
            <tbody>
            @foreach($cart as $item)
                <tr>
                    <td>{{ $item['title'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ money($item['price']) }}</td>
                    <td>{{ money($item['price'] * $item['quantity']) }}</td>
                    <td class="text-end">
                        <form method="post" action="{{ route('cart.remove', $item['id']) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-outline-danger">Cikar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <strong>Genel Toplam: {{ money($total) }}</strong>
        <a class="btn btn-primary" href="{{ route('checkout.form') }}">Odeme Ekrani</a>
    </div>
@else
    <div class="alert alert-info">Sepetiniz bos.</div>
@endif
@endsection

