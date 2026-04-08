@extends('layouts.app')

@section('title', $category->name)
@section('topbar-title', 'Detail Kategori')

@section('content')

<div class="breadcrumb">
    <a href="#">Dashboard</a> <span>/</span>
    <a href="{{ route('admin.categories.index') }}">Kategori</a> <span>/</span>
    <span>{{ $category->name }}</span>
</div>

<div class="page-header">
    <div style="display:flex; align-items:center; gap:1rem;">
        <span style="font-size:2.5rem;">{{ $category->icon ?? '📦' }}</span>
        <div>
            <h1 class="page-title">{{ $category->name }}</h1>
            <p class="page-subtitle">
                Slug: <code style="font-size:0.78rem;">{{ $category->slug }}</code>
            </p>
        </div>
    </div>
    <div style="display:flex; gap:0.6rem;">
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">Edit Kategori</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">← Kembali</a>
    </div>
</div>

{{-- Stat mini --}}
<div class="stat-row">
    <div class="stat-mini">
        <div class="stat-mini-label">Total Produk</div>
        <div class="stat-mini-val">{{ $category->products_count }}</div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-label">Ditambahkan</div>
        <div class="stat-mini-val" style="font-size:1rem; margin-top:0.5rem; font-weight:600;">
            {{ $category->created_at->format('d M Y') }}
        </div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-label">Terakhir Diupdate</div>
        <div class="stat-mini-val" style="font-size:1rem; margin-top:0.5rem; font-weight:600;">
            {{ $category->updated_at->diffForHumans() }}
        </div>
    </div>
</div>

{{-- Products in this category --}}
<div class="card">
    <div class="card-header">
        <span class="card-title">Produk dalam Kategori Ini</span>
        <a href="{{ route('admin.products.create') }}?category={{ $category->id }}" class="btn btn-outline btn-sm">
            + Tambah Produk
        </a>
    </div>

    @if($products->count())
    <div class="card-body">
        <div class="product-grid">
            @foreach($products as $product)
            <div class="product-mini-card">
                <div class="product-mini-img">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}"
                             style="width:100%; height:100%; object-fit:cover;"
                             alt="{{ $product->name }}">
                    @else
                        📦
                    @endif
                </div>
                <div class="product-mini-body">
                    <div class="product-mini-name">{{ $product->name }}</div>
                    <div class="product-mini-price">Rp {{ number_format($product->price_per_day, 0, ',', '.') }}/hari</div>
                    <div style="margin-top:0.4rem; display:flex; align-items:center; justify-content:space-between;">
                        <span class="badge {{ $product->is_available ? 'badge-green' : 'badge-red' }}" style="font-size:0.65rem;">
                            {{ $product->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                        </span>
                        <a href="{{ route('admin.products.edit', $product) }}"
                           style="font-size:0.72rem; color:var(--mid); text-decoration:none;">Edit →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($products->hasPages())
        <div style="margin-top:1.5rem;">
            {{ $products->links() }}
        </div>
        @endif
    </div>
    @else
    <div class="card-body" style="text-align:center; padding:3rem; color:var(--light);">
        <div style="font-size:2rem; margin-bottom:0.5rem;">📦</div>
        Belum ada produk di kategori ini.
        <br>
        <a href="{{ route('admin.products.create') }}" style="color:var(--peach); font-weight:600;">
            Tambah produk pertama →
        </a>
    </div>
    @endif
</div>

@endsection