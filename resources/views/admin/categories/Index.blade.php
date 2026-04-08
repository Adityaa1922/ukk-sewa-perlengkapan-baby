@extends('layouts.app')

@section('title', 'Kategori')
@section('topbar-title', 'Manajemen Kategori')

@section('content')

<div class="breadcrumb">
    <a href="#">Dashboard</a>
    <span>/</span>
    <span>Kategori</span>
</div>

<div class="page-header">
    <div>
        <h1 class="page-title">Kategori</h1>
        <p class="page-subtitle">{{ $categories->total() }} kategori terdaftar</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        + Tambah Kategori
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ikon</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th>Jumlah Produk</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td style="color:var(--light); font-size:0.75rem;">
                        {{ $categories->firstItem() + $loop->index }}
                    </td>
                    <td>
                        <span style="font-size:1.4rem;">{{ $category->icon ?? '📦' }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.categories.show', $category) }}"
                           style="font-weight:600; color:var(--dark); text-decoration:none;">
                            {{ $category->name }}
                        </a>
                    </td>
                    <td>
                        <code style="font-size:0.75rem; background:#F4F0EB; padding:0.15rem 0.5rem; border-radius:5px; color:var(--mid);">
                            {{ $category->slug }}
                        </code>
                    </td>
                    <td>
                        <span class="badge badge-gray">{{ $category->products_count }} produk</span>
                    </td>
                    <td style="color:var(--light);">{{ $category->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex; gap:0.4rem;">
                            <a href="{{ route('admin.categories.show', $category) }}"
                               class="btn btn-outline btn-sm">Lihat</a>
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="btn btn-outline btn-sm">Edit</a>
                            <form method="POST"
                                  action="{{ route('admin.categories.destroy', $category) }}"
                                  onsubmit="return confirm('Hapus kategori \'{{ $category->name }}\'?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:3rem; color:var(--light);">
                        <div style="font-size:2rem; margin-bottom:0.5rem;">🏷️</div>
                        Belum ada kategori. <a href="{{ route('admin.categories.create') }}" style="color:var(--peach);">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($categories->hasPages())
    <div style="padding:1rem 1.5rem; border-top:1px solid var(--border);">
        {{ $categories->links() }}
    </div>
    @endif
</div>

@endsection