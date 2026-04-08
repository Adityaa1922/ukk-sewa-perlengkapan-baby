@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('topbar-title', 'Tambah Kategori')

@section('content')

<div class="breadcrumb">
    <a href="#">Dashboard</a> <span>/</span>
    <a href="{{ route('admin.categories.index') }}">Kategori</a> <span>/</span>
    <span>Tambah</span>
</div>

<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Kategori</h1>
        <p class="page-subtitle">Buat kategori baru untuk mengelompokkan produk</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">← Kembali</a>
</div>

<div style="max-width:540px;">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Informasi Kategori</span>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="form-grid">

                    {{-- Nama --}}
                    <div class="form-group">
                        <label for="name">Nama Kategori <span style="color:var(--danger)">*</span></label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g. Stroller, Car Seat, Bouncer..."
                               autofocus>
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                        <span class="input-hint">Slug akan dibuat otomatis dari nama.</span>
                    </div>

                    {{-- Ikon --}}
                    <div class="form-group">
                        <label for="icon">Ikon (Emoji)</label>
                        <input type="text"
                               id="icon"
                               name="icon"
                               value="{{ old('icon') }}"
                               placeholder="🛒"
                               maxlength="4"
                               style="font-size:1.4rem;">
                        @error('icon')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                        <span class="input-hint">Salin & tempel emoji dari keyboard atau picker.</span>
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
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection