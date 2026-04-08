@extends('admin.layouts.app')

@section('title', 'Tambah Produk')
@section('topbar-title', 'Tambah Produk')

@section('content')

<div class="breadcrumb">
    <a href="#">Dashboard</a> <span>/</span>
    <a href="{{ route('admin.products.index') }}">Produk</a> <span>/</span>
    <span>Tambah</span>
</div>

<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Produk</h1>
        <p class="page-subtitle">Daftarkan peralatan bayi baru ke katalog</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline">← Kembali</a>
</div>

<form method="POST"
      action="{{ route('admin.products.store') }}"
      enctype="multipart/form-data">
    @csrf

    <div style="display:grid; grid-template-columns:1fr 280px; gap:1.5rem; align-items:start;">

        {{-- ── KIRI: Info Produk ── --}}
        <div style="display:flex; flex-direction:column; gap:1.2rem;">

            <div class="card">
                <div class="card-header"><span class="card-title">Informasi Dasar</span></div>
                <div class="card-body">
                    <div class="form-grid form-grid-2">

                        <div class="form-group span-2">
                            <label for="name">Nama Produk <span style="color:var(--danger)">*</span></label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name') }}"
                                   placeholder="e.g. Stroller Lipat UPPAbaby Vista">
                            @error('name') <span class="input-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id">Kategori <span style="color:var(--danger)">*</span></label>
                            <select id="category_id" name="category_id">
                                <option value="">— Pilih Kategori —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id', request('category')) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->icon }} {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="input-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="brand">Brand / Merk</label>
                            <input type="text" id="brand" name="brand"
                                   value="{{ old('brand') }}"
                                   placeholder="e.g. UPPAbaby, Joie, Graco">
                            @error('brand') <span class="input-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group span-2">
                            <label for="description">Deskripsi Produk</label>
                            <textarea id="description" name="description"
                                      placeholder="Jelaskan fitur, kondisi, dan keunggulan produk...">{{ old('description') }}</textarea>
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
                                   value="{{ old('price_per_day') }}"
                                   min="1000" step="500"
                                   placeholder="85000">
                            @error('price_per_day') <span class="input-error">{{ $message }}</span> @enderror
                            <span class="input-hint">Minimal Rp 1.000</span>
                        </div>

                        <div class="form-group">
                            <label for="stock">Jumlah Unit / Stok <span style="color:var(--danger)">*</span></label>
                            <input type="number" id="stock" name="stock"
                                   value="{{ old('stock', 1) }}"
                                   min="0">
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
                                   value="{{ old('min_age_month') }}"
                                   min="0" placeholder="0">
                            @error('min_age_month') <span class="input-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="max_age_month">Usia Maksimum (bulan)</label>
                            <input type="number" id="max_age_month" name="max_age_month"
                                   value="{{ old('max_age_month') }}"
                                   min="0" placeholder="36">
                            @error('max_age_month') <span class="input-error">{{ $message }}</span> @enderror
                            <span class="input-hint">Kosongkan jika tidak ada batas.</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ── KANAN: Gambar & Status ── --}}
        <div style="display:flex; flex-direction:column; gap:1.2rem;">

            <div class="card">
                <div class="card-header"><span class="card-title">Foto Produk</span></div>
                <div class="card-body" style="display:flex; flex-direction:column; align-items:center; gap:1rem;">
                    <label for="image" style="cursor:pointer; width:100%;">
                        <div class="img-preview-wrap" style="max-width:100%;" id="previewWrap">
                            <img id="previewImg" src="" alt="" style="display:none; width:100%; height:100%; object-fit:cover;">
                            <div class="img-placeholder" id="previewPlaceholder">📷</div>
                        </div>
                    </label>
                    <input type="file" id="image" name="image"
                           accept="image/jpg,image/jpeg,image/png,image/webp"
                           style="display:none;"
                           onchange="previewImage(this)">
                    <button type="button"
                            onclick="document.getElementById('image').click()"
                            class="btn btn-outline" style="width:100%;">
                        Pilih Foto
                    </button>
                    @error('image') <span class="input-error">{{ $message }}</span> @enderror
                    <span class="input-hint" style="text-align:center;">JPG, PNG, WebP. Maks 2MB.</span>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><span class="card-title">Status</span></div>
                <div class="card-body">
                    <div class="toggle-wrap">
                        <label class="toggle">
                            <input type="checkbox" name="is_available" value="1"
                                   {{ old('is_available', '1') ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <div>
                            <div style="font-size:0.84rem; font-weight:600;">Tersedia untuk Sewa</div>
                            <div style="font-size:0.75rem; color:var(--light);">Aktifkan agar produk tampil di katalog</div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display:flex; flex-direction:column; gap:0.6rem;">
                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:0.7rem;">
                    Simpan Produk
                </button>
                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-outline" style="width:100%; justify-content:center;">
                    Batal
                </a>
            </div>
        </div>

    </div>
</form>

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