@extends('admin.layouts.app')

@section('title', 'Produk')
@section('topbar-title', 'Manajemen Produk')

@section('content')

<div class="breadcrumb">
    <a href="#">Dashboard</a> <span>/</span>
    <span>Produk</span>
</div>

<div class="page-header">
    <div>
        <h1 class="page-title">Produk</h1>
        <p class="page-subtitle">{{ $products->total() }} produk terdaftar</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
</div>

{{-- Filter Bar --}}
<form method="GET" action="{{ route('admin.products.index') }}" style="margin-bottom:1.5rem;">
    <div class="filter-bar">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari nama / brand..."
               style="min-width:220px;">

        <select name="category">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->icon }} {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <select name="status">
            <option value="">Semua Status</option>
            <option value="available"    {{ request('status') === 'available'    ? 'selected' : '' }}>Tersedia</option>
            <option value="unavailable"  {{ request('status') === 'unavailable'  ? 'selected' : '' }}>Tidak Tersedia</option>
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
        @if(request()->hasAny(['search','category','status']))
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Reset</a>
        @endif
    </div>
</form>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga/Hari</th>
                    <th>Stok</th>
                    <th>Usia Bayi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td style="color:var(--light); font-size:0.75rem;">
                        {{ $products->firstItem() + $loop->index }}
                    </td>
                    <td>
                        <div style="display:flex; align-items:center; gap:0.75rem;">
                            <div style="width:40px; height:40px; border-radius:8px; background:#F4F0EB;
                                        display:flex; align-items:center; justify-content:center;
                                        font-size:1.3rem; flex-shrink:0; overflow:hidden;">
                                @if($product->image)
                                    <img src="{{ Storage::url($product->image) }}"
                                         style="width:100%; height:100%; object-fit:cover;"
                                         alt="">
                                @else
                                    📦
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('admin.products.show', $product) }}"
                                   style="font-weight:600; color:var(--dark); text-decoration:none; display:block;">
                                    {{ $product->name }}
                                </a>
                                @if($product->brand)
                                    <span style="font-size:0.72rem; color:var(--light);">{{ $product->brand }}</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="font-size:0.9rem;">{{ $product->category->icon ?? '📦' }}</span>
                        {{ $product->category->name }}
                    </td>
                    <td style="font-weight:600;">
                        Rp {{ number_format($product->price_per_day, 0, ',', '.') }}
                    </td>
                    <td>
                        <span class="badge {{ $product->stock > 0 ? 'badge-green' : 'badge-red' }}">
                            {{ $product->stock }} unit
                        </span>
                    </td>
                    <td style="color:var(--mid); font-size:0.8rem;">
                        {{ $product->ageRangeLabel() }}
                    </td>
                    <td>
                        <span class="badge {{ $product->is_available ? 'badge-green' : 'badge-red' }}">
                            {{ $product->is_available ? '● Tersedia' : '● Tidak Tersedia' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex; gap:0.4rem;">
                            <a href="{{ route('admin.products.show', $product) }}"
                               class="btn btn-outline btn-sm">Lihat</a>
                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="btn btn-outline btn-sm">Edit</a>
                            <form method="POST"
                                  action="{{ route('admin.products.destroy', $product) }}"
                                  onsubmit="return confirm('Hapus produk \'{{ $product->name }}\'?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:3rem; color:var(--light);">
                        <div style="font-size:2rem; margin-bottom:0.5rem;">📦</div>
                        Tidak ada produk ditemukan.
                        <a href="{{ route('admin.products.create') }}" style="color:var(--peach);">Tambah produk</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
    <div style="padding:1rem 1.5rem; border-top:1px solid var(--border);">
        {{ $products->links() }}
    </div>
    @endif
</div>

@endsection