@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Admin Paneli</h1>
    <a class="btn btn-primary" href="{{ route('admin.products.create') }}">Urun Ekle</a>
</div>

<ul class="nav nav-tabs mb-3" role="tablist">
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#products">Urunler</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#orders">Siparisler</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#users">Kullanicilar</button></li>
</ul>

<div class="tab-content">
    <section class="tab-pane fade show active" id="products">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Kitap</th><th>Fiyat</th><th>Stok</th><th>Durum</th><th></th></tr></thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ money($product->price) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->is_active ? 'Satista' : 'Kapali' }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.edit', $product) }}">Duzenle</a>
                            <form method="post" action="{{ route('admin.products.destroy', $product) }}" class="d-inline" onsubmit="return confirm('Silinsin mi?')">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-danger">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="tab-pane fade" id="orders">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>No</th><th>Kullanici</th><th>Tutar</th><th>Durum</th><th></th></tr></thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ money($order->total_amount) }}</td>
                        <td>{{ config('bookstore.order_steps.' . $order->status, $order->status) }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('orders.show', $order) }}">Detay</a>
                            @if(! in_array($order->status, ['delivered', 'completed', 'cancelled'], true))
                                <form method="post" action="{{ route('admin.orders.next', $order) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Ileri</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="tab-pane fade" id="users">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Ad Soyad</th><th>E-posta</th><th>Rol</th><th>Bakiye</th><th>Durum</th><th></th></tr></thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ money($user->wallet_balance) }}</td>
                        <td>{{ $user->status }}</td>
                        <td class="text-end">
                            @if(! $user->isAdmin())
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.users.edit', $user) }}">Duzenle</a>
                                <form method="post" action="{{ route('admin.users.status', $user) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $user->status === 'active' ? 'passive' : 'active' }}">
                                    <button class="btn btn-sm {{ $user->status === 'active' ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                        {{ $user->status === 'active' ? 'Dondur' : 'Aktif Et' }}
                                    </button>
                                </form>
                                <form method="post" action="{{ route('admin.users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Kullanici silinsin mi?')">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-outline-danger">Sil</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection

