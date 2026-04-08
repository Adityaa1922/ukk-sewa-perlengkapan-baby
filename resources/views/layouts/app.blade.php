<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — BabyRent</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700&family=dm-serif-display:400i" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --sidebar-w: 240px;
            --cream:     #FDF8F2;
            --peach:     #F5A88E;
            --peach-lt:  #FDE8D8;
            --sage:      #6B9E60;
            --sage-lt:   #A8C5A0;
            --dark:      #1E1E1E;
            --mid:       #5A5652;
            --light:     #9B9690;
            --border:    rgba(30,30,30,0.09);
            --white:     #FFFFFF;
            --danger:    #E5534B;
            --success:   #4CAF7D;
            --warning:   #F5B800;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--cream);
            color: var(--dark);
            display: flex;
            min-height: 100vh;
            font-size: 14px;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 50;
            overflow-y: auto;
        }
        .sidebar-logo {
            padding: 1.5rem 1.4rem 1.2rem;
            font-family: 'DM Serif Display', serif;
            font-size: 1.35rem;
            font-style: italic;
            color: var(--white);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex; align-items: center; gap: 0.5rem;
            text-decoration: none;
        }
        .sidebar-logo .dot {
            width: 8px; height: 8px;
            background: var(--peach);
            border-radius: 50%;
            display: inline-block;
        }
        .sidebar-section {
            padding: 1.2rem 0.8rem 0.4rem;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.28);
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.6rem 1rem;
            margin: 0.1rem 0.5rem;
            border-radius: 8px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.855rem;
            font-weight: 500;
            transition: all 0.18s ease;
        }
        .sidebar-link:hover {
            background: rgba(255,255,255,0.07);
            color: var(--white);
        }
        .sidebar-link.active {
            background: var(--peach);
            color: var(--white);
        }
        .sidebar-link .icon { font-size: 1rem; width: 20px; text-align: center; }
        .sidebar-bottom {
            margin-top: auto;
            padding: 1rem 0.5rem;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0; z-index: 40;
        }
        .topbar-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--dark);
        }
        .topbar-user {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--mid);
        }
        .topbar-avatar {
            width: 32px; height: 32px;
            background: var(--peach-lt);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--peach);
        }
        .page-content {
            padding: 2rem;
            flex: 1;
        }

        /* ── BREADCRUMB ── */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.78rem;
            color: var(--light);
            margin-bottom: 1.4rem;
        }
        .breadcrumb a { color: var(--mid); text-decoration: none; }
        .breadcrumb a:hover { color: var(--dark); }
        .breadcrumb span { color: var(--light); }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1.8rem;
            gap: 1rem;
        }
        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }
        .page-subtitle {
            font-size: 0.82rem;
            color: var(--light);
            margin-top: 0.25rem;
        }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1.1rem;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: 1.5px solid transparent;
            text-decoration: none;
            transition: all 0.18s ease;
            white-space: nowrap;
        }
        .btn-primary   { background: var(--dark); color: #fff; border-color: var(--dark); }
        .btn-primary:hover { background: #333; }
        .btn-danger    { background: var(--danger); color: #fff; border-color: var(--danger); }
        .btn-danger:hover  { background: #d44940; }
        .btn-outline   { background: transparent; color: var(--mid); border-color: var(--border); }
        .btn-outline:hover { border-color: var(--dark); color: var(--dark); }
        .btn-sm        { padding: 0.35rem 0.8rem; font-size: 0.76rem; }

        /* ── CARD ── */
        .card {
            background: var(--white);
            border-radius: 14px;
            border: 1.5px solid var(--border);
            overflow: hidden;
        }
        .card-header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .card-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--dark);
        }
        .card-body { padding: 1.5rem; }

        /* ── TABLE ── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th {
            text-align: left;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--light);
            padding: 0.85rem 1.2rem;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
            background: #FAFAF8;
        }
        td {
            padding: 0.9rem 1.2rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.83rem;
            color: var(--dark);
            vertical-align: middle;
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #FAFAF8; }

        /* ── BADGE ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.22rem 0.65rem;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 700;
        }
        .badge-green  { background: rgba(76,175,125,0.12); color: var(--success); }
        .badge-red    { background: rgba(229,83,75,0.12);  color: var(--danger); }
        .badge-yellow { background: rgba(245,184,0,0.12);  color: #c89600; }
        .badge-gray   { background: rgba(90,86,82,0.1);    color: var(--mid); }

        /* ── FORM ── */
        .form-grid   { display: grid; gap: 1.3rem; }
        .form-grid-2 { grid-template-columns: 1fr 1fr; }
        .form-grid-3 { grid-template-columns: 1fr 1fr 1fr; }
        .form-group  { display: flex; flex-direction: column; gap: 0.4rem; }
        .form-group.span-2 { grid-column: span 2; }
        .form-group.span-3 { grid-column: span 3; }
        label {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--mid);
        }
        input, select, textarea {
            width: 100%;
            padding: 0.6rem 0.85rem;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 0.84rem;
            font-family: inherit;
            color: var(--dark);
            background: var(--white);
            transition: border-color 0.18s ease, box-shadow 0.18s ease;
            outline: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--peach);
            box-shadow: 0 0 0 3px rgba(245,168,142,0.15);
        }
        textarea { resize: vertical; min-height: 100px; }
        .input-hint {
            font-size: 0.72rem;
            color: var(--light);
            margin-top: 0.15rem;
        }
        .input-error {
            font-size: 0.72rem;
            color: var(--danger);
            margin-top: 0.15rem;
        }
        .form-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            justify-content: flex-end;
            padding-top: 1.2rem;
            border-top: 1px solid var(--border);
            margin-top: 1.2rem;
        }

        /* ── TOGGLE ── */
        .toggle-wrap {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .toggle {
            position: relative;
            width: 40px;
            height: 22px;
        }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider {
            position: absolute;
            inset: 0;
            background: #D0CCC8;
            border-radius: 100px;
            cursor: pointer;
            transition: 0.2s;
        }
        .toggle-slider::before {
            content: '';
            position: absolute;
            width: 16px; height: 16px;
            left: 3px; top: 3px;
            background: white;
            border-radius: 50%;
            transition: 0.2s;
        }
        .toggle input:checked + .toggle-slider { background: var(--sage-lt); }
        .toggle input:checked + .toggle-slider::before { transform: translateX(18px); }

        /* ── ALERTS ── */
        .alert {
            padding: 0.85rem 1.2rem;
            border-radius: 10px;
            font-size: 0.83rem;
            font-weight: 500;
            margin-bottom: 1.4rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .alert-success { background: rgba(76,175,125,0.1); color: #2d7a54; border: 1px solid rgba(76,175,125,0.2); }
        .alert-error   { background: rgba(229,83,75,0.08); color: #c0372f; border: 1px solid rgba(229,83,75,0.2); }

        /* ── FILTER BAR ── */
        .filter-bar {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            flex-wrap: wrap;
        }
        .filter-bar input, .filter-bar select {
            width: auto;
            min-width: 180px;
        }

        /* ── STAT MINI ── */
        .stat-row { display: flex; gap: 1rem; margin-bottom: 1.8rem; }
        .stat-mini {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            padding: 1rem 1.4rem;
            flex: 1;
        }
        .stat-mini-label { font-size: 0.72rem; font-weight: 600; color: var(--light); text-transform: uppercase; letter-spacing: 0.06em; }
        .stat-mini-val   { font-size: 1.7rem; font-weight: 700; color: var(--dark); margin-top: 0.2rem; line-height: 1; }

        /* ── IMAGE PREVIEW ── */
        .img-preview-wrap {
            position: relative;
            width: 100%;
            max-width: 180px;
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            border: 2px dashed var(--border);
            background: #FAFAF8;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: border-color 0.18s;
        }
        .img-preview-wrap:hover { border-color: var(--peach); }
        .img-preview-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .img-placeholder { font-size: 2.5rem; opacity: 0.25; }

        /* ── PAGINATION ── */
        .pagination { display: flex; gap: 0.3rem; margin-top: 1.5rem; justify-content: flex-end; }
        .page-item a, .page-item span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px; height: 32px;
            border-radius: 7px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--mid);
            text-decoration: none;
            border: 1.5px solid var(--border);
            transition: all 0.15s;
        }
        .page-item.active span { background: var(--dark); color: white; border-color: var(--dark); }
        .page-item a:hover { border-color: var(--dark); color: var(--dark); }

        /* ── PRODUCT GRID (show category) ── */
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; }
        .product-mini-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .product-mini-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.08); transform: translateY(-2px); }
        .product-mini-img { aspect-ratio: 1; background: #F4F0EB; display: flex; align-items: center; justify-content: center; font-size: 3rem; }
        .product-mini-body { padding: 0.8rem; }
        .product-mini-name { font-size: 0.82rem; font-weight: 600; margin-bottom: 0.2rem; }
        .product-mini-price { font-size: 0.78rem; color: var(--peach); font-weight: 700; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main { margin-left: 0; }
            .form-grid-2, .form-grid-3 { grid-template-columns: 1fr; }
            .form-group.span-2, .form-group.span-3 { grid-column: span 1; }
            .stat-row { flex-wrap: wrap; }
        }
    </style>
</head>
<body>

{{-- ── SIDEBAR ── --}}
<aside class="sidebar">
    <a href="{{ route('admin.categories.index') }}" class="sidebar-logo">
        BabyRent <span class="dot"></span>
    </a>

    <div class="sidebar-section">Katalog</div>
    <a href="{{ route('admin.categories.index') }}"
       class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        <span class="icon">🏷️</span> Kategori
    </a>
    <a href="{{ route('admin.products.index') }}"
       class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
        <span class="icon">📦</span> Produk
    </a>

    <div class="sidebar-section">Transaksi</div>
    <a href="#" class="sidebar-link">
        <span class="icon">📋</span> Sewa
    </a>
    <a href="#" class="sidebar-link">
        <span class="icon">💳</span> Pembayaran
    </a>

    <div class="sidebar-section">Pengguna</div>
    <a href="#" class="sidebar-link">
        <span class="icon">👥</span> Semua User
    </a>
    <a href="#" class="sidebar-link">
        <span class="icon">🪪</span> Petugas
    </a>

    <div class="sidebar-bottom">
        <a href="#" class="sidebar-link">
            <span class="icon">⚙️</span> Pengaturan
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link" style="width:100%; background:none; border:none; text-align:left; cursor:pointer;">
                <span class="icon">🚪</span> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- ── MAIN ── --}}
<div class="main">
    <header class="topbar">
        <span class="topbar-title">@yield('topbar-title', 'Dashboard')</span>
        <div class="topbar-user">
            <div class="topbar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <span>{{ auth()->user()->name }}</span>
            <span class="badge badge-yellow" style="font-size:0.62rem;">{{ ucfirst(auth()->user()->role) }}</span>
        </div>
    </header>

    <div class="page-content">
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</div>

<script>
    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            el.style.transition = 'opacity 0.4s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        });
    }, 4000);
</script>
@stack('scripts')
</body>
</html>