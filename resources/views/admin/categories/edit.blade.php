@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('topbar-title', 'Edit Kategori')

@section('content')

<div class="breadcrumb">
    <a href="#">Dashboard</a> <span>/</span>
    <a href="{{ route('admin.categories.index') }}">Kategori</a> <span>/</span>
    <a href="{{ route('admin.categories.show', $category) }}">{{ $category->name }}</a> <span>/</span>
    <span>Edit</span>
</div>

<div class="page-header">
    <div style="display:flex; align-items:center; gap:0.8rem;">
        <span style="font-size:2rem;">{{ $category->icon ?? '📦' }}</span>
        <div>
            <h1 class="page-title">Edit: {{ $category->name }}</h1>
            <p class="page-subtitle">Perbarui informasi kategori</p>
        </div>
    </div>
    <div style="display:flex; gap:0.6rem;">
        <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-outline">← Detail</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Semua Kategori</a>
    </div>
</div>

<div style="max-width:540px;">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Informasi Kategori</span>
            <span class="badge badge-gray">ID #{{ $category->id }}</span>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf @method('PUT')
                <div class="form-grid">

                    {{-- Nama --}}
                    <div class="form-group">
                        <label for="name">Nama Kategori <span style="color:var(--danger)">*</span></label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $category->name) }}"
                               autofocus>
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                        <span class="input-hint">
                            Slug saat ini:
                            <code style="font-size:0.72rem; background:#F4F0EB; padding:0.1rem 0.4rem; border-radius:4px;">{{ $category->slug }}</code>
                        </span>
                    </div>

                    {{-- Ikon --}}
                    <div class="form-group">
                        <label for="icon">Ikon (Emoji)</label>
                        <input type="text"
                               id="icon"
                               name="icon"
                               value="{{ old('icon', $category->icon) }}"
                               maxlength="4"
                               style="font-size:1.4rem;">
                        @error('icon')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Quick emoji picker --}}
                    <div class="form-group">
                        <label>Pilih Cepat</label>
                        <div style="display:flex; flex-wrap:wrap; gap:0.4rem;">
                            @foreach(['🛒','🪑','🚗','🛏️','🍼','🧸','🚿','🎠','👶','🎒','🧴','⚕️'] as $emoji)
                            <button type="button"
                                    onclick="document.getElementById('icon').value='{{ $emoji }}'"
                                    style="font-size:1.4rem; padding:0.3rem 0.5rem; border:1.5px solid var(--border); border-radius:8px; background:white; cursor:pointer; transition:border-color 0.15s;"
                                    onmouseover="this.style.borderColor='var(--peach)'"
                                    onmouseout="this.style.borderColor='var(--border)'">
                                {{ $emoji }}
                            </button>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-outline">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Danger zone --}}
    <div class="card" style="margin-top:1.2rem; border-color:rgba(229,83,75,0.2);">
        <div class="card-header" style="background:rgba(229,83,75,0.04);">
            <span class="card-title" style="color:var(--danger);">⚠️ Zona Berbahaya</span>
        </div>
        <div class="card-body">
            <p style="font-size:0.83rem; color:var(--mid); margin-bottom:1rem;">
                Menghapus kategori bersifat permanen dan tidak dapat dibatalkan.
                Kategori hanya bisa dihapus jika tidak memiliki produk.
            </p>
            <form method="POST"
                  action="{{ route('admin.categories.destroy', $category) }}"
                  onsubmit="return confirm('Yakin ingin menghapus kategori \'{{ $category->name }}\'? Tindakan ini tidak dapat dibatalkan.')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus Kategori Ini</button>
            </form>
        </div>
    </div>
</div>

@endsection