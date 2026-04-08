<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'BabyRent') }} — Sewa Peralatan Bayi</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=dm-serif-display:400,400i|dm-sans:300,400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            :root {
                --cream: #FDF8F2;
                --peach: #F9C8A8;
                --blush: #F5A88E;
                --sage: #A8C5A0;
                --sage-dark: #6B9E60;
                --sky: #B8D8E8;
                --lavender: #D4C5E2;
                --text-dark: #2C2C2C;
                --text-mid: #6B6560;
                --text-light: #A09890;
                --white: #FFFFFF;
                --shadow-soft: 0 4px 24px rgba(44,44,44,0.08);
                --shadow-card: 0 8px 40px rgba(44,44,44,0.10);
            }

            * { box-sizing: border-box; margin: 0; padding: 0; }

            body {
                font-family: 'DM Sans', sans-serif;
                background-color: var(--cream);
                color: var(--text-dark);
                min-height: 100vh;
                overflow-x: hidden;
            }

            /* ── NAV ── */
            nav.main-nav {
                position: fixed;
                top: 0; left: 0; right: 0;
                z-index: 100;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 1rem 2.5rem;
                background: rgba(253,248,242,0.85);
                backdrop-filter: blur(12px);
                border-bottom: 1px solid rgba(249,200,168,0.3);
            }

            .nav-logo {
                font-family: 'DM Serif Display', serif;
                font-size: 1.5rem;
                color: var(--text-dark);
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .nav-logo span.dot {
                display: inline-block;
                width: 10px; height: 10px;
                background: var(--blush);
                border-radius: 50%;
                margin-bottom: 2px;
            }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .nav-links a {
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--text-mid);
                text-decoration: none;
                padding: 0.45rem 1.1rem;
                border-radius: 100px;
                border: 1.5px solid transparent;
                transition: all 0.2s ease;
            }

            .nav-links a:hover {
                color: var(--text-dark);
                border-color: var(--peach);
                background: rgba(249,200,168,0.12);
            }

            .nav-links a.btn-primary {
                background: var(--text-dark);
                color: var(--white);
                border-color: var(--text-dark);
            }

            .nav-links a.btn-primary:hover {
                background: #444;
                border-color: #444;
            }

            /* ── HERO ── */
            .hero {
                min-height: 100vh;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 0;
                padding-top: 72px;
            }

            .hero-left {
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 4rem 3rem 4rem 5rem;
                position: relative;
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                background: rgba(168,197,160,0.2);
                border: 1.5px solid var(--sage);
                color: var(--sage-dark);
                font-size: 0.78rem;
                font-weight: 600;
                letter-spacing: 0.06em;
                text-transform: uppercase;
                padding: 0.35rem 0.9rem;
                border-radius: 100px;
                width: fit-content;
                margin-bottom: 1.5rem;
                animation: fadeUp 0.6s ease both;
            }

            .hero-badge::before {
                content: '✦';
                font-size: 0.7rem;
            }

            .hero-title {
                font-family: 'DM Serif Display', serif;
                font-size: clamp(2.8rem, 5vw, 4.2rem);
                line-height: 1.08;
                color: var(--text-dark);
                margin-bottom: 1.4rem;
                animation: fadeUp 0.7s 0.1s ease both;
            }

            .hero-title em {
                font-style: italic;
                color: var(--blush);
            }

            .hero-subtitle {
                font-size: 1.05rem;
                color: var(--text-mid);
                line-height: 1.7;
                max-width: 420px;
                margin-bottom: 2.5rem;
                font-weight: 300;
                animation: fadeUp 0.7s 0.2s ease both;
            }

            .hero-cta {
                display: flex;
                gap: 1rem;
                align-items: center;
                flex-wrap: wrap;
                animation: fadeUp 0.7s 0.3s ease both;
            }

            .btn-cta {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.85rem 2rem;
                border-radius: 100px;
                font-size: 0.95rem;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.25s ease;
                cursor: pointer;
                border: none;
            }

            .btn-cta.dark {
                background: var(--text-dark);
                color: var(--white);
                box-shadow: 0 4px 16px rgba(44,44,44,0.2);
            }

            .btn-cta.dark:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 24px rgba(44,44,44,0.28);
            }

            .btn-cta.outline {
                background: transparent;
                color: var(--text-dark);
                border: 1.5px solid rgba(44,44,44,0.25);
            }

            .btn-cta.outline:hover {
                border-color: var(--text-dark);
                background: rgba(44,44,44,0.04);
            }

            .hero-stats {
                display: flex;
                gap: 2rem;
                margin-top: 3rem;
                padding-top: 2rem;
                border-top: 1px solid rgba(44,44,44,0.08);
                animation: fadeUp 0.7s 0.4s ease both;
            }

            .stat-item {
                display: flex;
                flex-direction: column;
                gap: 0.2rem;
            }

            .stat-num {
                font-family: 'DM Serif Display', serif;
                font-size: 1.9rem;
                color: var(--text-dark);
                line-height: 1;
            }

            .stat-label {
                font-size: 0.78rem;
                color: var(--text-light);
                font-weight: 500;
                letter-spacing: 0.02em;
            }

            /* ── HERO RIGHT ── */
            .hero-right {
                position: relative;
                background: linear-gradient(135deg, #FDE8D8 0%, #F9D4C0 40%, #EFC4B0 100%);
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .hero-right::before {
                content: '';
                position: absolute;
                top: -60px; right: -60px;
                width: 300px; height: 300px;
                background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 70%);
                border-radius: 50%;
            }

            .hero-right::after {
                content: '';
                position: absolute;
                bottom: -80px; left: -40px;
                width: 250px; height: 250px;
                background: radial-gradient(circle, rgba(168,197,160,0.3) 0%, transparent 70%);
                border-radius: 50%;
            }

            .hero-illustration {
                position: relative;
                z-index: 2;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
                padding: 3rem;
                max-width: 480px;
                width: 100%;
            }

            .product-card-mini {
                background: white;
                border-radius: 20px;
                padding: 1.2rem;
                box-shadow: var(--shadow-card);
                transition: transform 0.3s ease;
                cursor: default;
            }

            .product-card-mini:hover {
                transform: translateY(-4px) rotate(-1deg);
            }

            .product-card-mini:nth-child(2) {
                margin-top: 1.5rem;
            }

            .product-card-mini:nth-child(3) {
                margin-top: -1rem;
            }

            .product-card-mini .emoji {
                font-size: 2.4rem;
                margin-bottom: 0.6rem;
                display: block;
            }

            .product-card-mini .name {
                font-size: 0.78rem;
                font-weight: 600;
                color: var(--text-dark);
                margin-bottom: 0.2rem;
            }

            .product-card-mini .price {
                font-size: 0.72rem;
                color: var(--blush);
                font-weight: 600;
            }

            .product-card-mini .badge-avail {
                display: inline-block;
                background: rgba(168,197,160,0.25);
                color: var(--sage-dark);
                font-size: 0.65rem;
                font-weight: 600;
                padding: 0.15rem 0.5rem;
                border-radius: 100px;
                margin-top: 0.4rem;
            }

            /* ── SECTION: HOW IT WORKS ── */
            .section {
                padding: 6rem 5rem;
            }

            .section-inner {
                max-width: 1100px;
                margin: 0 auto;
            }

            .section-label {
                font-size: 0.78rem;
                font-weight: 600;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: var(--blush);
                margin-bottom: 0.8rem;
            }

            .section-title {
                font-family: 'DM Serif Display', serif;
                font-size: clamp(2rem, 3.5vw, 2.8rem);
                line-height: 1.15;
                color: var(--text-dark);
                margin-bottom: 1rem;
            }

            .section-title em {
                font-style: italic;
                color: var(--blush);
            }

            .section-desc {
                font-size: 1rem;
                color: var(--text-mid);
                font-weight: 300;
                line-height: 1.7;
                max-width: 500px;
                margin-bottom: 3rem;
            }

            /* ── HOW IT WORKS ── */
            .steps-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
            }

            .step-card {
                background: white;
                border-radius: 24px;
                padding: 2rem;
                box-shadow: var(--shadow-soft);
                border: 1.5px solid rgba(44,44,44,0.06);
                transition: box-shadow 0.3s ease, transform 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .step-card::before {
                content: '';
                position: absolute;
                top: 0; left: 0; right: 0;
                height: 4px;
                border-radius: 24px 24px 0 0;
            }

            .step-card:nth-child(1)::before { background: var(--peach); }
            .step-card:nth-child(2)::before { background: var(--sage); }
            .step-card:nth-child(3)::before { background: var(--sky); }

            .step-card:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow-card);
            }

            .step-number {
                font-family: 'DM Serif Display', serif;
                font-size: 3rem;
                color: rgba(44,44,44,0.06);
                line-height: 1;
                margin-bottom: 1rem;
                font-style: italic;
            }

            .step-icon {
                font-size: 2rem;
                margin-bottom: 1rem;
                display: block;
            }

            .step-title {
                font-size: 1.05rem;
                font-weight: 600;
                color: var(--text-dark);
                margin-bottom: 0.6rem;
            }

            .step-desc {
                font-size: 0.88rem;
                color: var(--text-mid);
                line-height: 1.65;
                font-weight: 300;
            }

            /* ── PRODUCTS ── */
            .products-section {
                padding: 6rem 5rem;
                background: white;
            }

            .products-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1.5rem;
                margin-top: 0;
            }

            .product-card {
                background: var(--cream);
                border-radius: 20px;
                padding: 1.5rem;
                border: 1.5px solid rgba(44,44,44,0.06);
                transition: all 0.3s ease;
                cursor: pointer;
                position: relative;
                overflow: hidden;
            }

            .product-card:hover {
                transform: translateY(-6px);
                box-shadow: var(--shadow-card);
                border-color: var(--peach);
            }

            .product-emoji-wrap {
                width: 100%;
                aspect-ratio: 1;
                background: white;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 3.5rem;
                margin-bottom: 1rem;
                box-shadow: var(--shadow-soft);
            }

            .product-name {
                font-size: 0.9rem;
                font-weight: 600;
                color: var(--text-dark);
                margin-bottom: 0.3rem;
            }

            .product-meta {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 0.8rem;
            }

            .product-price {
                font-family: 'DM Serif Display', serif;
                font-size: 1.1rem;
                color: var(--text-dark);
            }

            .product-price span {
                font-family: 'DM Sans', sans-serif;
                font-size: 0.72rem;
                color: var(--text-light);
                font-weight: 400;
            }

            .product-tag {
                font-size: 0.68rem;
                font-weight: 600;
                padding: 0.2rem 0.6rem;
                border-radius: 100px;
                background: rgba(168,197,160,0.2);
                color: var(--sage-dark);
            }

            .product-tag.popular {
                background: rgba(245,168,142,0.15);
                color: var(--blush);
            }

            /* ── WHY US ── */
            .why-section {
                padding: 6rem 5rem;
                background: linear-gradient(160deg, #FDF8F2 0%, #FDE8D8 100%);
            }

            .why-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 5rem;
                align-items: center;
            }

            .why-list {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
                margin-top: 2rem;
            }

            .why-item {
                display: flex;
                gap: 1.2rem;
                align-items: flex-start;
            }

            .why-icon {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                flex-shrink: 0;
            }

            .why-icon.peach { background: rgba(249,200,168,0.3); }
            .why-icon.sage  { background: rgba(168,197,160,0.3); }
            .why-icon.sky   { background: rgba(184,216,232,0.4); }
            .why-icon.lav   { background: rgba(212,197,226,0.3); }

            .why-text h4 {
                font-size: 0.95rem;
                font-weight: 600;
                color: var(--text-dark);
                margin-bottom: 0.3rem;
            }

            .why-text p {
                font-size: 0.85rem;
                color: var(--text-mid);
                line-height: 1.65;
                font-weight: 300;
            }

            /* Testimonial side */
            .testimonial-stack {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .testimonial-card {
                background: white;
                border-radius: 20px;
                padding: 1.5rem;
                box-shadow: var(--shadow-soft);
                border: 1.5px solid rgba(44,44,44,0.05);
                transition: transform 0.3s ease;
            }

            .testimonial-card:hover { transform: translateX(4px); }

            .testimonial-card:nth-child(2) {
                margin-left: 2rem;
            }

            .testimonial-stars {
                color: #F5B800;
                font-size: 0.8rem;
                margin-bottom: 0.7rem;
                letter-spacing: 0.1em;
            }

            .testimonial-text {
                font-size: 0.88rem;
                color: var(--text-mid);
                line-height: 1.65;
                font-weight: 300;
                margin-bottom: 1rem;
                font-style: italic;
            }

            .testimonial-author {
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .author-avatar {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1rem;
                flex-shrink: 0;
            }

            .avatar-a { background: rgba(249,200,168,0.4); }
            .avatar-b { background: rgba(168,197,160,0.4); }
            .avatar-c { background: rgba(212,197,226,0.4); }

            .author-name {
                font-size: 0.82rem;
                font-weight: 600;
                color: var(--text-dark);
            }

            .author-city {
                font-size: 0.72rem;
                color: var(--text-light);
            }

            /* ── CTA BANNER ── */
            .cta-section {
                padding: 5rem;
                background: var(--text-dark);
            }

            .cta-inner {
                max-width: 1100px;
                margin: 0 auto;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 3rem;
            }

            .cta-content h2 {
                font-family: 'DM Serif Display', serif;
                font-size: clamp(2rem, 3vw, 2.5rem);
                color: var(--white);
                line-height: 1.2;
                margin-bottom: 0.8rem;
            }

            .cta-content h2 em {
                font-style: italic;
                color: var(--peach);
            }

            .cta-content p {
                font-size: 0.95rem;
                color: rgba(255,255,255,0.55);
                font-weight: 300;
                line-height: 1.6;
            }

            .cta-buttons {
                display: flex;
                gap: 1rem;
                flex-shrink: 0;
            }

            .btn-cta.light {
                background: var(--cream);
                color: var(--text-dark);
            }

            .btn-cta.light:hover {
                background: white;
                transform: translateY(-2px);
            }

            .btn-cta.ghost-white {
                background: transparent;
                color: rgba(255,255,255,0.65);
                border: 1.5px solid rgba(255,255,255,0.2);
            }

            .btn-cta.ghost-white:hover {
                border-color: rgba(255,255,255,0.5);
                color: white;
            }

            /* ── FOOTER ── */
            footer {
                background: var(--cream);
                border-top: 1px solid rgba(44,44,44,0.08);
                padding: 2rem 5rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            footer .footer-logo {
                font-family: 'DM Serif Display', serif;
                font-size: 1.2rem;
                color: var(--text-dark);
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 0.4rem;
            }

            footer .footer-copy {
                font-size: 0.8rem;
                color: var(--text-light);
            }

            footer .footer-links {
                display: flex;
                gap: 1.5rem;
            }

            footer .footer-links a {
                font-size: 0.82rem;
                color: var(--text-mid);
                text-decoration: none;
                transition: color 0.2s;
            }

            footer .footer-links a:hover {
                color: var(--text-dark);
            }

            /* ── ANIMATIONS ── */
            @keyframes fadeUp {
                from { opacity: 0; transform: translateY(20px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            .fade-up {
                opacity: 0;
                transform: translateY(24px);
                transition: opacity 0.6s ease, transform 0.6s ease;
            }

            .fade-up.visible {
                opacity: 1;
                transform: translateY(0);
            }

            /* ── RESPONSIVE ── */
            @media (max-width: 1024px) {
                .hero { grid-template-columns: 1fr; }
                .hero-right { min-height: 380px; }
                .hero-left { padding: 3rem 2.5rem; }
                .products-grid { grid-template-columns: repeat(2, 1fr); }
                .why-grid { grid-template-columns: 1fr; }
                .steps-grid { grid-template-columns: 1fr; }
                .section { padding: 4rem 2.5rem; }
                .products-section { padding: 4rem 2.5rem; }
                .why-section { padding: 4rem 2.5rem; }
                .cta-section { padding: 3rem 2.5rem; }
                .cta-inner { flex-direction: column; align-items: flex-start; }
                footer { padding: 2rem 2.5rem; flex-wrap: wrap; gap: 1rem; }
            }

            @media (max-width: 640px) {
                nav.main-nav { padding: 1rem 1.5rem; }
                .hero-left { padding: 2rem 1.5rem; }
                .products-grid { grid-template-columns: 1fr 1fr; }
                .hero-illustration { grid-template-columns: 1fr 1fr; padding: 1.5rem; }
            }
        </style>
    </head>

    <body>

        {{-- ── NAVBAR (Auth logic dipertahankan) ── --}}
        <nav class="main-nav">
            <a href="/" class="nav-logo">
                BabyRent <span class="dot"></span>
            </a>

            @if (Route::has('login'))
                <div class="nav-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Masuk</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary">Daftar Gratis</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>

        {{-- ── HERO ── --}}
        <section class="hero">
            <div class="hero-left">
                <span class="hero-badge">✦ Terpercaya & Higienis</span>

                <h1 class="hero-title">
                    Sewa Peralatan<br>
                    Bayi yang <em>Nyaman</em><br>
                    & Terjangkau
                </h1>

                <p class="hero-subtitle">
                    Tidak perlu beli mahal. Sewa peralatan bayi berkualitas — stroller, bouncer, car seat, dan lebih banyak lagi — diantar ke pintu rumahmu.
                </p>

                <div class="hero-cta">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-cta dark">
                            Mulai Sewa Sekarang →
                        </a>
                    @endif
                    <a href="#produk" class="btn-cta outline">Lihat Katalog</a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-num">500+</span>
                        <span class="stat-label">Produk Tersedia</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-num">2k+</span>
                        <span class="stat-label">Pelanggan Puas</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-num">4.9★</span>
                        <span class="stat-label">Rating Rata-rata</span>
                    </div>
                </div>
            </div>

            <div class="hero-right">
                <div class="hero-illustration">
                    <div class="product-card-mini">
                        <span class="emoji">🛒</span>
                        <div class="name">Stroller Lipat</div>
                        <div class="price">Rp 85.000/hari</div>
                        <span class="badge-avail">Tersedia</span>
                    </div>
                    <div class="product-card-mini">
                        <span class="emoji">🪑</span>
                        <div class="name">Bouncer Bayi</div>
                        <div class="price">Rp 45.000/hari</div>
                        <span class="badge-avail">Tersedia</span>
                    </div>
                    <div class="product-card-mini">
                        <span class="emoji">🚗</span>
                        <div class="name">Car Seat</div>
                        <div class="price">Rp 95.000/hari</div>
                        <span class="badge-avail">Tersedia</span>
                    </div>
                    <div class="product-card-mini">
                        <span class="emoji">🛏️</span>
                        <div class="name">Box Bayi</div>
                        <div class="price">Rp 65.000/hari</div>
                        <span class="badge-avail">Tersedia</span>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── HOW IT WORKS ── --}}
        <section class="section">
            <div class="section-inner">
                <p class="section-label fade-up">Cara Kerja</p>
                <h2 class="section-title fade-up">Semudah <em>3 Langkah</em></h2>
                <p class="section-desc fade-up">Proses sewa yang simpel dan cepat. Dari pilih produk hingga diantar ke rumahmu dalam hitungan jam.</p>

                <div class="steps-grid">
                    <div class="step-card fade-up">
                        <div class="step-number">01</div>
                        <span class="step-icon">🔍</span>
                        <h3 class="step-title">Pilih Produk</h3>
                        <p class="step-desc">Jelajahi ratusan pilihan peralatan bayi dari brand terpercaya. Filter sesuai usia dan kebutuhan si kecil.</p>
                    </div>
                    <div class="step-card fade-up">
                        <div class="step-number">02</div>
                        <span class="step-icon">📅</span>
                        <h3 class="step-title">Tentukan Durasi</h3>
                        <p class="step-desc">Pilih tanggal mulai dan selesai sewa. Sewa harian, mingguan, hingga bulanan dengan harga yang makin hemat.</p>
                    </div>
                    <div class="step-card fade-up">
                        <div class="step-number">03</div>
                        <span class="step-icon">🏠</span>
                        <h3 class="step-title">Terima di Rumah</h3>
                        <p class="step-desc">Produk bersih, tersanitasi, dan dikemas rapi. Diantar ke rumahmu — dan dijemput saat masa sewa berakhir.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── PRODUCTS ── --}}
        <section class="products-section" id="produk">
            <div class="section-inner">
                <p class="section-label fade-up">Katalog Produk</p>
                <h2 class="section-title fade-up">Produk <em>Terpopuler</em></h2>
                <p class="section-desc fade-up">Peralatan bayi premium, selalu bersih dan siap pakai. Semua produk dicek kualitas sebelum dikirim.</p>

                <div class="products-grid">
                    <div class="product-card fade-up">
                        <div class="product-emoji-wrap">🛒</div>
                        <div class="product-name">Stroller Premium</div>
                        <div style="font-size:0.78rem; color:var(--text-light); margin-top:0.2rem;">Cocok 0–36 bulan</div>
                        <div class="product-meta">
                            <div class="product-price">Rp 85k <span>/hari</span></div>
                            <span class="product-tag popular">⭐ Populer</span>
                        </div>
                    </div>
                    <div class="product-card fade-up">
                        <div class="product-emoji-wrap">🪑</div>
                        <div class="product-name">Bouncer & Rocker</div>
                        <div style="font-size:0.78rem; color:var(--text-light); margin-top:0.2rem;">Cocok 0–18 bulan</div>
                        <div class="product-meta">
                            <div class="product-price">Rp 45k <span>/hari</span></div>
                            <span class="product-tag">Tersedia</span>
                        </div>
                    </div>
                    <div class="product-card fade-up">
                        <div class="product-emoji-wrap">🚗</div>
                        <div class="product-name">Car Seat Infant</div>
                        <div style="font-size:0.78rem; color:var(--text-light); margin-top:0.2rem;">Cocok 0–12 bulan</div>
                        <div class="product-meta">
                            <div class="product-price">Rp 95k <span>/hari</span></div>
                            <span class="product-tag popular">⭐ Populer</span>
                        </div>
                    </div>
                    <div class="product-card fade-up">
                        <div class="product-emoji-wrap">🛏️</div>
                        <div class="product-name">Tempat Tidur Bayi</div>
                        <div style="font-size:0.78rem; color:var(--text-light); margin-top:0.2rem;">Cocok 0–24 bulan</div>
                        <div class="product-meta">
                            <div class="product-price">Rp 65k <span>/hari</span></div>
                            <span class="product-tag">Tersedia</span>
                        </div>
                    </div>
                    <div class="product-card fade-up">
                        <div class="product-emoji-wrap">🍼</div>
                        <div class="product-name">Sterilizer Botol</div>
                        <div style="font-size:0.78rem; color:var(--text-light); margin-top:0.2rem;">Kapasitas 6 botol</div>
                        <div class="product-meta">
                            <div class="product-price">Rp 35k <span>/hari</span></div>
                            <span class="product-tag">Tersedia</span>
                        </div>
                    </div>
                    <div class="product-card fade-up">
                        <div class="product-emoji-wrap">🧸</div>
                        <div class="product-name">Baby Gym Mat</div>
                        <div style="font-size:0.78rem; color:var(--text-light); margin-top:0.2rem;">Cocok 3–12 bulan</div>
                        <div class="product-meta">
                            <div class="product-price">Rp 30k <span>/hari</span></div>
                            <span class="product-tag">Tersedia</span>
                        </div>
                    </div>
                    <div class="product-card fade-up">
                        <div class="product-emoji-wrap">🚿</div>
                        <div class="product-name">Baby Bath Tub</div>
                        <div style="font-size:0.78rem; color:var(--text-light); margin-top:0.2rem;">Ergonomis & antislip</div>
                        <div class="product-meta">
                            <div class="product-price">Rp 25k <span>/hari</span></div>
                            <span class="product-tag">Tersedia</span>
                        </div>
                    </div>
                    <div class="product-card fade-up">
                        <div class="product-emoji-wrap">🎠</div>
                        <div class="product-name">Baby Swing</div>
                        <div style="font-size:0.78rem; color:var(--text-light); margin-top:0.2rem;">Cocok 0–9 bulan</div>
                        <div class="product-meta">
                            <div class="product-price">Rp 55k <span>/hari</span></div>
                            <span class="product-tag popular">⭐ Populer</span>
                        </div>
                    </div>
                </div>

                <div style="text-align:center; margin-top:3rem;">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-cta dark">Lihat Semua Produk →</a>
                    @endif
                </div>
            </div>
        </section>

        {{-- ── WHY US + TESTIMONIALS ── --}}
        <section class="why-section">
            <div class="section-inner">
                <div class="why-grid">
                    <div>
                        <p class="section-label fade-up">Kenapa BabyRent?</p>
                        <h2 class="section-title fade-up">Lebih <em>Hemat</em>,<br>Sama Nyamannya</h2>
                        <p class="section-desc fade-up">Kami percaya setiap keluarga berhak memberikan yang terbaik untuk si kecil, tanpa perlu menguras kantong.</p>

                        <div class="why-list">
                            <div class="why-item fade-up">
                                <div class="why-icon peach">🧼</div>
                                <div class="why-text">
                                    <h4>Sanitasi Bersertifikat</h4>
                                    <p>Setiap produk dicuci, disterilisasi, dan dicek kelayakannya sebelum dikirim ke pelanggan berikutnya.</p>
                                </div>
                            </div>
                            <div class="why-item fade-up">
                                <div class="why-icon sage">🚚</div>
                                <div class="why-text">
                                    <h4>Antar Jemput Gratis</h4>
                                    <p>Pengiriman dan penjemputan gratis dalam kota. Jadwalkan sesuai waktu yang paling nyaman untukmu.</p>
                                </div>
                            </div>
                            <div class="why-item fade-up">
                                <div class="why-icon sky">🔄</div>
                                <div class="why-text">
                                    <h4>Perpanjang Kapan Saja</h4>
                                    <p>Butuh lebih lama? Perpanjang masa sewa cukup dari aplikasi, tanpa perlu menghubungi CS.</p>
                                </div>
                            </div>
                            <div class="why-item fade-up">
                                <div class="why-icon lav">💬</div>
                                <div class="why-text">
                                    <h4>Support 24/7</h4>
                                    <p>Tim kami siap membantu kapanpun kamu membutuhkan — via WhatsApp, chat, atau telepon.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-stack">
                        <div class="testimonial-card fade-up">
                            <div class="testimonial-stars">★★★★★</div>
                            <p class="testimonial-text">"Strollernya mulus banget, bersih, dan kondisi prima. Anak saya langsung nyaman. Proses sewa juga super mudah, recommended banget!"</p>
                            <div class="testimonial-author">
                                <div class="author-avatar avatar-a">👩</div>
                                <div>
                                    <div class="author-name">Sari Dewi</div>
                                    <div class="author-city">Jakarta Selatan</div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card fade-up">
                            <div class="testimonial-stars">★★★★★</div>
                            <p class="testimonial-text">"Harga jauh lebih hemat dibanding beli. Anak cepet besar, sayang kalau beli mahal. BabyRent solusi terbaik untuk keluarga muda!"</p>
                            <div class="testimonial-author">
                                <div class="author-avatar avatar-b">👨</div>
                                <div>
                                    <div class="author-name">Budi Santoso</div>
                                    <div class="author-city">Surabaya</div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card fade-up">
                            <div class="testimonial-stars">★★★★★</div>
                            <p class="testimonial-text">"Antar jemputnya tepat waktu dan petugasnya ramah. Sudah 3x sewa di sini dan selalu puas. Kapok beli sekarang, mending sewa!"</p>
                            <div class="testimonial-author">
                                <div class="author-avatar avatar-c">👩</div>
                                <div>
                                    <div class="author-name">Nadia Pramesti</div>
                                    <div class="author-city">Bandung</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── CTA BANNER ── --}}
        <section class="cta-section">
            <div class="cta-inner">
                <div class="cta-content">
                    <h2>Siap Memberikan yang <em>Terbaik</em><br>untuk Si Kecil?</h2>
                    <p>Daftar gratis dan dapatkan diskon 20% untuk sewa pertamamu.</p>
                </div>
                <div class="cta-buttons">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-cta light">Daftar Sekarang</a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn-cta ghost-white">Sudah punya akun</a>
                    @endif
                </div>
            </div>
        </section>

        {{-- ── FOOTER ── --}}
        <footer>
            <a href="/" class="footer-logo">BabyRent <span class="dot"></span></a>
            <span class="footer-copy">© 2025 BabyRent. All rights reserved.</span>
            <div class="footer-links">
                <a href="#">Tentang Kami</a>
                <a href="#">Cara Kerja</a>
                <a href="#">Kontak</a>
                <a href="#">FAQ</a>
            </div>
        </footer>

        {{-- Scroll Animation Script --}}
        <script>
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

            document.querySelectorAll('.fade-up').forEach((el, i) => {
                el.style.transitionDelay = `${(i % 4) * 0.08}s`;
                observer.observe(el);
            });
        </script>

    </body>
</html>