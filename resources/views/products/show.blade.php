@extends('layouts.app')

@section('content')
<div class="row g-4 align-items-start">
    <div class="col-md-5">
        <img src="{{ product_image($product->image_url) }}" class="img-fluid rounded product-detail-img" alt="{{ $product->title }}">
    </div>
    <div class="col-md-7">
        <h1>{{ $product->title }}</h1>
        <p class="text-muted">{{ $product->author }}</p>
        <p>{!! nl2br(e($product->description)) !!}</p>
        <div class="d-flex gap-3 align-items-center mb-3">
            <span class="h4 mb-0">{{ money($product->price) }}</span>
            <span class="badge text-bg-secondary">Stok: {{ $product->stock }}</span>
        </div>
        @auth
            <form method="post" action="{{ route('cart.add') }}" class="d-flex gap-2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input class="form-control quantity-input" type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                <button class="btn btn-primary">Sepete Ekle</button>
            </form>
        @else
            <a class="btn btn-primary" href="{{ route('login') }}">Sepete eklemek icin giris yap</a>
        @endauth
    </div>
</div>
@endsection

