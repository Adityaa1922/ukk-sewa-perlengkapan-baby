@extends('admin.layouts.app')

@section('title', 'Edit Produk')
@section('topbar-title', 'Edit Produk')

@section('content')

<div class="breadcrumb">
    <a href="#">Dashboard</a> <span>/</span>
    <a href="{{ route('admin.products.index') }}">Produk</a> <span>/</span>
    <a href="{{ route('admin.products.show', $product) }}">{{ $product->name }}</a> <span>/</span>
    <span>Edit</span>
</div>

<div class="page-header">
    <div>
        <h1 class="page-title">Edit: {{ $product->name }}</h1>
        <p class="page-subtitle">Perbarui informasi produk</p>
    </div>
    <div style="display:flex; gap:0.6rem;">
        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-outline">← Detail</a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Semua Produk</a>
    </div>
</div>

<form method="POST"
      action="{{ route('admin.products.update', $product) }}"
      enctype="multipart/form-data">
    @csrf @method('PUT')

    <div style="display:grid; grid-template-columns:1fr 280px; gap:1.5rem; align-items:start;">

        {{-- ── KIRI ── --}}
        <div style="display:flex; flex-direction:column; gap:1.2rem;">

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Informasi Dasar</span>
                    <span class="badge badge-gray">ID #{{ $product->id }}</span>
                </div>
                <div class="card-body">
                    <div class="form-grid form-grid-2">

                        <div class="form-group span-2">
                            <label for="name">Nama Produk <span style="color:var(--danger)">*</span></label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name', $product->name) }}">
                            @error('name') <span class="input-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id">Kategori <span style="color:var(--danger)">*</span></label>
                            <select id="category_id" name="category_id">
                                <option value="">— Pilih Kategori —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->icon }} {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="input-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="brand">Brand / Merk</label>
                            <input type="text" id="brand" name="brand"
                                   value="{{ old('brand', $product->brand) }}">
                            @error('brand') <span class="input-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group span-2">
                            <label for="description">Deskripsi Produk</label>
                            <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
                            @error('description') <span class="input-error">{{ $message }}</span> @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><span class="card-title">Harga & Stok</span></div>
                <div class="card-body">
                    <div class="form-grid form-grid-2">
                        <div class="form-group">
                            <label for="price_per_day">Harga per Hari (Rp) <span style="color:var(--danger)">*</span></label>
                            <input type="number" id="price_per_day" name="price_per_day"
                                   value="{{ old('price_per_day', $product->price_per_day) }}"
                                   min="1000" step="500">
                            @error('price_per_day') <span class="input-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Jumlah Unit / Stok <span style="color:var(--danger)">*</span></label>
                            <input type="number" id="stock" name="stock"
                                   value="{{ old('stock', $product->stock) }}" min="0">
                            @error('stock') <span class="input-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><span class="card-title">Usia Bayi yang Disarankan</span></div>
                <div class="card-body">
                    <div class="form-grid form-grid-2">
                        <div class="form-group">
                            <label for="min_age_month">Usia Minimum (bulan)</label>
                            <input type="number" id="min_age_month" name="min_age_month"
                                   value="{{ old('min_age_month', $product->min_age_month) }}" min="0">
                            @error('min_age_month') <span class="input-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="max_age_month">Usia Maksimum (bulan)</label>
                            <input type="number" id="max_age_month" name="max_age_month"
                                   value="{{ old('max_age_month', $product->max_age_month) }}" min="0">
                            @error('max_age_month') <span class="input-error">{{ $message }}</span> @enderror
                            <span class="input-hint">Kosongkan jika tidak ada batas.</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ── KANAN ── --}}
        <div style="display:flex; flex-direction:column; gap:1.2rem;">

            <div class="card">
                <div class="card-header"><span class="card-title">Foto Produk</span></div>
                <div class="card-body" style="display:flex; flex-direction:column; align-items:center; gap:1rem;">
                    <label for="image" style="cursor:pointer; width:100%;">
                        <div class="img-preview-wrap" style="max-width:100%;">
                            <img id="previewImg"
                                 src="{{ $product->image ? Storage::url($product->image) : '' }}"
                                 alt="{{ $product->name }}"
                                 style="{{ $product->image ? '' : 'display:none;' }} width:100%; height:100%; object-fit:cover;">
                            <div class="img-placeholder" id="previewPlaceholder" style="{{ $product->image ? 'display:none;' : '' }}">📷</div>
                        </div>
                    </label>
                    <input type="file" id="image" name="image"
                           accept="image/jpg,image/jpeg,image/png,image/webp"
                           style="display:none;"
                           onchange="previewImage(this)">
                    <button type="button"
                            onclick="document.getElementById('image').click()"
                            class="btn btn-outline" style="width:100%;">
                        {{ $product->image ? 'Ganti Foto' : 'Pilih Foto' }}
                    </button>
                    @error('image') <span class="input-error">{{ $message }}</span> @enderror
                    <span class="input-hint" style="text-align:center;">Biarkan kosong jika tidak ingin mengganti foto.</span>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><span class="card-title">Status</span></div>
                <div class="card-body">
                    <div class="toggle-wrap">
                        <label class="toggle">
                            <input type="checkbox" name="is_available" value="1"
                                   {{ old('is_available', $product->is_available) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <div>
                            <div style="font-size:0.84rem; font-weight:600;">Tersedia untuk Sewa</div>
                            <div style="font-size:0.75rem; color:var(--light);">Nonaktifkan untuk menyembunyikan dari katalog</div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display:flex; flex-direction:column; gap:0.6rem;">
                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:0.7rem;">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.products.show', $product) }}"
                   class="btn btn-outline" style="width:100%; justify-content:center;">
                    Batal
                </a>
            </div>
        </div>

    </div>
</form>

{{-- Danger Zone --}}
<div class="card" style="margin-top:1.5rem; border-color:rgba(229,83,75,0.2); max-width:480px;">
    <div class="card-header" style="background:rgba(229,83,75,0.04);">
        <span class="card-title" style="color:var(--danger);">⚠️ Zona Berbahaya</span>
    </div>
    <div class="card-body">
        <p style="font-size:0.83rem; color:var(--mid); margin-bottom:1rem;">
            Menghapus produk bersifat permanen. Foto produk juga akan terhapus dari server.
        </p>
        <form method="POST"
              action="{{ route('admin.products.destroy', $product) }}"
              onsubmit="return confirm('Yakin hapus produk \'{{ $product->name }}\'? Tidak dapat dibatalkan.')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus Produk Ini</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewImage(input) {
    const img  = document.getElementById('previewImg');
    const placeholder = document.getElementById('previewPlaceholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            img.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush