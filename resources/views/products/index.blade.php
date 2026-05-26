@extends('layouts.app')

@section('content')
<section class="hero mb-4">
    <div>
        <p class="text-uppercase small fw-bold text-primary mb-2">Laravel Kitap Satis Sitesi</p>
        <h1 class="display-5 fw-bold">Okumak istedigin kitaplari sepete ekle, siparisini takip et.</h1>
        <p class="lead text-muted">Admin urunleri ve siparis surecini yonetir; kullanici sepete ekler, odeme yapar ve teslimat durumunu izler.</p>
    </div>
</section>

<div class="row g-4">
    @forelse ($products as $product)
        <div class="col-sm-6 col-lg-3">
            <div class="card product-card h-100">
                <img src="{{ product_image($product->image_url) }}" class="card-img-top" alt="{{ $product->title }}">
                <div class="card-body d-flex flex-column">
                    <h2 class="h6">{{ $product->title }}</h2>
                    <p class="small text-muted mb-2">{{ $product->author }}</p>
                    <p class="fw-bold mb-3">{{ money($product->price) }}</p>
                    <a class="btn btn-primary mt-auto" href="{{ route('products.show', $product) }}">Detay</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">Aradiginiz kriterlere uygun urun bulunamadi.</div>
        </div>
    @endforelse
</div>
@endsection

