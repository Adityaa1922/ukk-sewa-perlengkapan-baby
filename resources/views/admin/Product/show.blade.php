@extends('admin.layouts.app')

@section('title', $product->name)
@section('topbar-title', 'Detail Produk')

@section('content')

<div class="breadcrumb">
    <a href="#">Dashboard</a> <span>/</span>
    <a href="{{ route('admin.products.index') }}">Produk</a> <span>/</span>
    <span>{{ $product->name }}</span>
</div>

<div class="page-header">
    <h1 class="page-title">{{ $product->name }}</h1>
    <div style="display:flex; gap:0.6rem;">
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">Edit Produk</a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline">← Kembali</a>
    </div>
</div>

<div style="display:grid; grid-template-columns:300px 1fr; gap:1.5rem; align-items:start;">

    {{-- Gambar --}}
    <div class="card">
        <div style="aspect-ratio:1; background:#F4F0EB; display:flex; align-items:center; justify-content:center; font-size:5rem;">
            @if($product->image)
                <img src="{{ Storage::url($product->image) }}"
                     style="width:100%; height:100%; object-fit:cover;"
                     alt="{{ $product->name }}">
            @else
                📦
            @endif
        </div>
        <div class="card-body" style="padding:1rem;">
            <div style="display:flex; align-items:center; justify-content:space-between;">
                <span class="badge {{ $product->is_available ? 'badge-green' : 'badge-red' }}" style="font-size:0.75rem;">
                    {{ $product->is_available ? '● Tersedia' : '● Tidak Tersedia' }}
                </span>
                <span style="font-size:0.75rem; color:var(--light);">Stok: {{ $product->stock }} unit</span>
            </div>
        </div>
    </div>

    {{-- Detail --}}
    <div style="display:flex; flex-direction:column; gap:1.2rem;">

        {{-- Info utama --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Informasi Produk</span>
                <span class="badge badge-gray">ID #{{ $product->id }}</span>
            </div>
            <div class="card-body">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.2rem;">
                    <div>
                        <div style="font-size:0.72rem; font-weight:600; color:var(--light); text-transform:uppercase; letter-spacing:0.06em; margin-bottom:0.3rem;">Kategori</div>
                        <div style="display:flex; align-items:center; gap:0.4rem;">
                            <span>{{ $product->category->icon ?? '📦' }}</span>
                            <a href="{{ route('admin.categories.show', $product->category) }}"
                               style="font-weight:600; color:var(--dark); text-decoration:none;">
                                {{ $product->category->name }}
                            </a>
                        </div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem; font-weight:600; color:var(--light); text-transform:uppercase; letter-spacing:0.06em; margin-bottom:0.3rem;">Brand</div>
                        <div style="font-weight:500;">{{ $product->brand ?? '—' }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem; font-weight:600; color:var(--light); text-transform:uppercase; letter-spacing:0.06em; margin-bottom:0.3rem;">Harga Sewa</div>
                        <div style="font-size:1.3rem; font-weight:700; color:var(--dark);">
                            Rp {{ number_format($product->price_per_day, 0, ',', '.') }}
                            <span style="font-size:0.78rem; font-weight:400; color:var(--light);">/hari</span>
                        </div>
                    </div>
                    <div>
                        <div style="font-size:0.72rem; font-weight:600; color:var(--light); text-transform:uppercase; letter-spacing:0.06em; margin-bottom:0.3rem;">Usia Bayi</div>
                        <div style="font-weight:500;">{{ $product->ageRangeLabel() }}</div>
                    </div>
                    <div style="grid-column:span 2;">
                        <div style="font-size:0.72rem; font-weight:600; color:var(--light); text-transform:uppercase; letter-spacing:0.06em; margin-bottom:0.3rem;">Slug</div>
                        <code style="font-size:0.78rem; background:#F4F0EB; padding:0.2rem 0.6rem; border-radius:6px;">{{ $product->slug }}</code>
                    </div>
                    @if($product->description)
                    <div style="grid-column:span 2;">
                        <div style="font-size:0.72rem; font-weight:600; color:var(--light); text-transform:uppercase; letter-spacing:0.06em; margin-bottom:0.3rem;">Deskripsi</div>
                        <p style="font-size:0.85rem; color:var(--mid); line-height:1.65;">{{ $product->description }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Harga simulasi --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Simulasi Harga Sewa</span>
            </div>
            <div class="card-body">
                <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:0.75rem;">
                    @foreach([1 => '1 Hari', 3 => '3 Hari', 7 => '1 Minggu', 30 => '1 Bulan'] as $days => $label)
                    <div style="background:#F4F0EB; border-radius:10px; padding:0.85rem; text-align:center;">
                        <div style="font-size:0.7rem; color:var(--light); font-weight:600; margin-bottom:0.3rem;">{{ $label }}</div>
                        <div style="font-size:0.95rem; font-weight:700;">
                            Rp {{ number_format($product->priceFor($days), 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Meta --}}
        <div class="card">
            <div class="card-body" style="display:flex; gap:2rem;">
                <div>
                    <div style="font-size:0.72rem; color:var(--light); font-weight:600;">Dibuat</div>
                    <div style="font-size:0.83rem; margin-top:0.2rem;">{{ $product->created_at->format('d M Y, H:i') }}</div>
                </div>
                <div>
                    <div style="font-size:0.72rem; color:var(--light); font-weight:600;">Terakhir Diupdate</div>
                    <div style="font-size:0.83rem; margin-top:0.2rem;">{{ $product->updated_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection