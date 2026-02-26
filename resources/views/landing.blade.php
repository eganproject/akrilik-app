@extends('layouts.landing', ['title' => 'Akrilik Teknika'])

@section('custom_style')
<script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444', // Primary Red
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                            dark: '#0f172a'
                        },
                        accent: {
                            500: '#f8b04f',
                            600: '#e59a2f'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 8s ease-in-out infinite',
                        'float-slow': 'float 14s ease-in-out infinite',
                        'fade-in-up': 'fadeInUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'aurora': 'aurora 12s ease-in-out infinite',
                        'drift': 'drift 16s ease-in-out infinite',
                        'pulse-soft': 'pulseSoft 6s ease-in-out infinite',
                        'shimmer': 'shimmer 6s linear infinite',
                        'scanline': 'scanline 3.5s linear infinite',
                        'spin-slow': 'spin 16s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-16px)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        aurora: {
                            '0%, 100%': { transform: 'translate3d(0, 0, 0) scale(1)', opacity: '0.7' },
                            '50%': { transform: 'translate3d(40px, -30px, 0) scale(1.08)', opacity: '1' },
                        },
                        drift: {
                            '0%, 100%': { transform: 'translate3d(0, 0, 0)' },
                            '50%': { transform: 'translate3d(-40px, 30px, 0)' },
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '0.35' },
                            '50%': { opacity: '0.85' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '0% 50%' },
                            '100%': { backgroundPosition: '200% 50%' },
                        },
                        scanline: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(100%)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .lux-hero-bg {
            background-image: url('{{ asset('public/assets/images/about.jpeg') }}');
            background-size: cover;
            background-position: center;
        }
        .glass-nav {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .hero-grid {
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.08) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 48px 48px;
            opacity: 0.2;
        }
        .hero-dots {
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 22px 22px;
            opacity: 0.25;
        }
        .glass-panel {
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .lux-card {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 30px 60px rgba(15, 23, 42, 0.08);
        }
        .gradient-border {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.14), rgba(255, 255, 255, 0.04)) padding-box,
                linear-gradient(135deg, rgba(239, 68, 68, 0.9), rgba(255, 255, 255, 0.25)) border-box;
            border: 1px solid transparent;
        }
        .scanline {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.7), transparent);
            animation: scanline 3.5s linear infinite;
        }
        .shimmer-overlay {
            background: linear-gradient(110deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.35), rgba(255, 255, 255, 0.05));
            background-size: 200% 100%;
            animation: shimmer 6s linear infinite;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .logo-marquee-container {
            width: 100%;
            overflow: hidden;
            position: relative;
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
        .logo-marquee-content {
            display: flex;
            width: max-content;
            animation: marquee 60s linear infinite;
        }
        .logo-marquee-content:hover {
            animation-play-state: paused;
        }
        .logo-marquee-content img {
            transform: scale(1.06);
            transform-origin: center;
            filter: brightness(0) invert(1);
            opacity: 0.7;
        }
        .reveal-item {
            opacity: 0;
            transform: translateY(30px);
            transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal-item.active {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-line {
            width: 0;
            transition: width 1.2s ease-out;
        }
        .reveal-line.active {
            width: 100%;
        }
        .category-item.active {
            background-color: #fef2f2;
            color: #ef4444;
            border-right: 3px solid #ef4444;
        }
        .category-item.active svg {
            opacity: 1 !important;
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
@endsection

@section('content')
    <section id="home" class="relative min-h-screen overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0 lux-hero-bg"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-900/60 to-slate-950"></div>
        <div class="absolute inset-0 hero-grid"></div>
        <div class="absolute inset-0 hero-dots"></div>

        <div class="absolute -top-20 -left-20 w-72 h-72 bg-brand-500/30 blur-3xl rounded-full animate-aurora"></div>
        <div class="absolute top-1/3 -right-24 w-96 h-96 bg-rose-500/20 blur-3xl rounded-full animate-drift"></div>
        <div class="absolute bottom-[-180px] left-1/2 -translate-x-1/2 w-[720px] h-[720px] bg-white/5 blur-3xl rounded-full animate-pulse-soft"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-36 pb-24">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-8">
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm shadow-lg shadow-black/20 reveal-item">
                        <span class="w-2 h-2 rounded-full bg-red-400 animate-pulse"></span>
                        <span class="text-xs uppercase tracking-[0.35em] text-slate-200">Akrilik Teknika</span>
                    </div>
                    <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-bold leading-[1.05] reveal-item">
                        Display Akrilik <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-200 via-white to-brand-300">Rapi & Premium</span>
                        untuk Brand, Toko, dan Kafe.
                    </h1>
                    <p class="text-lg sm:text-xl text-slate-200/90 max-w-2xl reveal-item">
                        Produk akrilik custom seperti frame poster, rak brosur, rak kopi, menu stand, dan display meja. Desain modern, potongan presisi, dan finishing bening untuk tampil profesional sejak pandangan pertama.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 reveal-item">
                        <a href="https://wa.me/6285385136547" class="px-8 py-4 rounded-full bg-brand-500 text-white font-bold shadow-xl shadow-brand-500/30 hover:bg-brand-600 transition-all">
                            Konsultasi Gratis
                        </a>
                        <a href="{{ route('kategori') }}" class="px-8 py-4 rounded-full border border-white/30 text-white font-semibold backdrop-blur-sm hover:bg-white/10 transition-all">
                            Lihat Katalog
                        </a>
                    </div>
                    <div class="grid grid-cols-3 gap-4 pt-4 reveal-item">
                        <div class="glass-panel rounded-2xl p-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-300">Pengalaman</p>
                            <p class="text-2xl font-bold text-white">5+ Tahun</p>
                        </div>
                        <div class="glass-panel rounded-2xl p-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-300">Proyek</p>
                            <p class="text-2xl font-bold text-white">500+</p>
                        </div>
                        <div class="glass-panel rounded-2xl p-4">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-300">Dukungan</p>
                            <p class="text-2xl font-bold text-white">24/7</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 relative">
                    <div class="gradient-border glass-panel p-8 rounded-3xl shadow-2xl relative overflow-hidden reveal-item delay-200">
                        <div class="absolute inset-0 pointer-events-none">
                            <div class="scanline"></div>
                        </div>
                        <div class="absolute -top-12 -right-12 w-32 h-32 bg-brand-500/20 blur-3xl rounded-full"></div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.35em] text-slate-300">Signature Kit</p>
                                <h3 class="font-display text-2xl font-bold text-white">Acrylic Display Suite</h3>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-white/10 text-xs text-slate-200">2026</span>
                        </div>
                        <p class="mt-4 text-slate-200/80 text-sm">Paket display akrilik untuk area kasir, meja promo, etalase, hingga booth event. Cocok untuk menonjolkan produk dan informasi penting.</p>

                        <div class="mt-6 overflow-hidden rounded-2xl border border-white/10">
                            <div class="h-40 w-full bg-center bg-cover" style="background-image: url('{{ asset('public/assets/images/about.jpeg') }}');"></div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <div class="rounded-2xl bg-white/5 border border-white/10 p-4">
                                <div class="flex items-center gap-3">
                                    <span class="w-9 h-9 rounded-xl bg-brand-500/20 text-brand-200 flex items-center justify-center">
                                        <i data-lucide="sparkles" class="w-5 h-5"></i>
                                    </span>
                                    <div>
                                        <p class="text-xs text-slate-300">Material</p>
                                        <p class="text-sm font-semibold text-white">Akrilik Berkualitas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded-2xl bg-white/5 border border-white/10 p-4">
                                <div class="flex items-center gap-3">
                                    <span class="w-9 h-9 rounded-xl bg-brand-500/20 text-brand-200 flex items-center justify-center">
                                        <i data-lucide="cpu" class="w-5 h-5"></i>
                                    </span>
                                    <div>
                                        <p class="text-xs text-slate-300">Custom</p>
                                        <p class="text-sm font-semibold text-white">Ukuran & Branding</p>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded-2xl bg-white/5 border border-white/10 p-4">
                                <div class="flex items-center gap-3">
                                    <span class="w-9 h-9 rounded-xl bg-brand-500/20 text-brand-200 flex items-center justify-center">
                                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                                    </span>
                                    <div>
                                        <p class="text-xs text-slate-300">Finishing</p>
                                        <p class="text-sm font-semibold text-white">Bening & Rapi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded-2xl bg-white/5 border border-white/10 p-4">
                                <div class="flex items-center gap-3">
                                    <span class="w-9 h-9 rounded-xl bg-brand-500/20 text-brand-200 flex items-center justify-center">
                                        <i data-lucide="zap" class="w-5 h-5"></i>
                                    </span>
                                    <div>
                                        <p class="text-xs text-slate-300">Produksi</p>
                                        <p class="text-sm font-semibold text-white">Cepat & Konsisten</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="trust" class="relative py-12 bg-slate-950 text-slate-300 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xs font-bold uppercase tracking-[0.4em] text-slate-400 mb-6">Dipercaya Oleh</p>
            <div class="logo-marquee-container">
                <div class="logo-marquee-content items-center transition-opacity duration-500">
                    <div class="flex gap-16 items-center shrink-0 pr-16">
                        <img src="{{ asset('public/assets/brand_partner/1.png') }}" alt="Partner 1" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/2.png') }}" alt="Partner 2" class="h-10 md:h-14 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/3.png') }}" alt="Partner 3" class="h-10 md:h-14 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/4.png') }}" alt="Partner 4" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/5.png') }}" alt="Partner 5" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/6.png') }}" alt="Partner 6" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/7.png') }}" alt="Partner 7" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/8.png') }}" alt="Partner 8" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/9.png') }}" alt="Partner 9" class="h-10 md:h-12 object-contain shrink-0">
                    </div>
                    <div class="flex gap-16 items-center shrink-0 pr-16">
                        <img src="{{ asset('public/assets/brand_partner/1.png') }}" alt="Partner 1" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/2.png') }}" alt="Partner 2" class="h-10 md:h-14 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/3.png') }}" alt="Partner 3" class="h-10 md:h-14 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/4.png') }}" alt="Partner 4" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/5.png') }}" alt="Partner 5" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/6.png') }}" alt="Partner 6" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/7.png') }}" alt="Partner 7" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/8.png') }}" alt="Partner 8" class="h-10 md:h-12 object-contain shrink-0">
                        <img src="{{ asset('public/assets/brand_partner/9.png') }}" alt="Partner 9" class="h-10 md:h-12 object-contain shrink-0">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="products" class="relative py-24 bg-slate-50 overflow-hidden">
        <div class="absolute -top-20 -left-20 w-[420px] h-[420px] bg-brand-200/40 blur-3xl rounded-full"></div>
        <div class="absolute -bottom-20 -right-20 w-[420px] h-[420px] bg-rose-200/50 blur-3xl rounded-full"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-12">
                <div class="reveal-item">
                    <p class="text-brand-600 font-bold tracking-[0.3em] uppercase text-xs mb-3">Produk Akrilik</p>
                    <h2 class="font-display text-4xl md:text-5xl font-bold text-slate-900">
                        Jajaran Display Akrilik <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-500 to-accent-500">Favorit Bisnis.</span>
                    </h2>
                    <p class="text-slate-600 mt-4 max-w-2xl">
                        Frame poster, rak brosur, rak kopi, menu stand, display meja, hingga signage. Semua bisa dibuat sesuai ukuran dan kebutuhan brand Anda.
                    </p>
                </div>
                <a href="/kategori" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-slate-900 text-white font-semibold hover:bg-slate-800 transition">
                    Lihat Semua Kategori
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @forelse(($featuredCategories ?? []) as $i => $feat)
                    @php
                        $cat = $feat->category;
                    @endphp
                    <div class="group relative reveal-item">
                        <div class="lux-card rounded-3xl p-6 sm:p-7 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-brand-500/10 border border-white/70">
                            <div class="absolute inset-0 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity bg-gradient-to-b from-white/40 to-transparent pointer-events-none"></div>
                            <div class="relative z-10">
                                <div class="h-44 flex items-center justify-center rounded-2xl bg-white border border-slate-100 shadow-sm">
                                    @if($cat?->image)
                                        <img src="{{ \App\Support\MediaUrl::publicStorage($cat->image) }}" alt="{{ $cat->name }}" class="h-full w-auto object-contain drop-shadow-md animate-float">
                                    @else
                                        <div class="h-28 w-28 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-xl animate-float">
                                            {{ strtoupper(substr($cat->name ?? 'X',0,2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-6 flex items-center justify-between">
                                    <div>
                                        <h4 class="text-lg font-display font-bold text-slate-900 group-hover:text-brand-600 transition-colors">{{ $cat?->name ?? 'Kategori' }}</h4>
                                        <p class="text-xs text-slate-500">Produk Akrilik</p>
                                    </div>
                                    @if($cat)
                                        <a href="{{ route('kategori.show', $cat->slug) }}" class="w-11 h-11 rounded-full bg-slate-900 text-white flex items-center justify-center group-hover:bg-brand-600 transition">
                                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-slate-500 text-sm">Belum ada kategori unggulan yang dipilih.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="studio" class="relative py-28 bg-white overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000008_1px,transparent_1px),linear-gradient(to_bottom,#00000008_1px,transparent_1px)] bg-[size:36px_36px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-14 items-center mb-16">
                <div class="reveal-item">
                    <p class="text-brand-600 font-bold tracking-[0.3em] uppercase text-xs mb-3">Keunggulan Produksi</p>
                    <h3 class="font-display text-4xl md:text-5xl font-bold text-slate-900">
                        Akrilik Presisi <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-500 to-accent-500">Finishing Bening.</span>
                    </h3>
                    <p class="text-slate-600 mt-5 text-lg">
                        Kami mengolah akrilik dengan cutting, bending, dan polishing presisi untuk hasil rapi, kuat, dan terlihat profesional di setiap sudut.
                    </p>
                    <div class="mt-8 h-[2px] bg-slate-200 w-full relative overflow-visible rounded-full max-w-[200px]">
                        <div class="reveal-line absolute top-0 left-0 h-full bg-gradient-to-r from-brand-500 via-brand-300 to-accent-500 animate-pulse-soft"></div>
                    </div>
                </div>
                <div class="reveal-item delay-200">
                    <div class="relative rounded-3xl border border-slate-200 shadow-2xl overflow-hidden bg-slate-900 text-white">
                        <div class="absolute inset-0 shimmer-overlay opacity-20"></div>
                        <div class="p-8 relative">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="w-12 h-12 rounded-2xl bg-brand-500/20 text-brand-200 flex items-center justify-center">
                                    <i data-lucide="sparkles" class="w-6 h-6"></i>
                                </span>
                                <div>
                                    <p class="text-xs uppercase tracking-[0.35em] text-slate-300">AT Acrylic Lab</p>
                                    <h4 class="font-display text-2xl font-bold">Blueprint Display Custom</h4>
                                </div>
                            </div>
                            <div class="space-y-3 text-slate-200/80 text-sm">
                                <div class="flex items-center gap-3">
                                    <span class="w-2 h-2 rounded-full bg-brand-300"></span>
                                    <p>Desain custom sesuai ukuran, fungsi, dan identitas brand.</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="w-2 h-2 rounded-full bg-brand-300"></span>
                                    <p>Cutting, bending, dan polishing untuk tepi halus.</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="w-2 h-2 rounded-full bg-brand-300"></span>
                                    <p>Finishing rapi untuk tampilan bening dan profesional.</p>
                                </div>
                            </div>
                            <div class="mt-8 flex items-center justify-between">
                                <div class="text-xs text-slate-400">Premium Assurance</div>
                                <div class="text-xs font-semibold text-brand-200">Gold Standard</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="reveal-item group p-8 rounded-3xl border border-slate-200 bg-white hover:border-brand-500/40 hover:shadow-xl transition-all duration-500">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mb-5 border border-brand-100">
                        <i data-lucide="settings" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Potong Presisi</h4>
                    <p class="text-slate-600 text-sm leading-relaxed">Laser cutting akurat menjaga ukuran konsisten dan bentuk tetap rapi.</p>
                </div>
                <div class="reveal-item delay-100 group p-8 rounded-3xl border border-slate-200 bg-white hover:border-brand-500/40 hover:shadow-xl transition-all duration-500">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mb-5 border border-brand-100">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Finishing Halus</h4>
                    <p class="text-slate-600 text-sm leading-relaxed">Polishing detail membuat akrilik bening, bersih, dan nyaman dilihat.</p>
                </div>
                <div class="reveal-item delay-200 group p-8 rounded-3xl border border-slate-200 bg-white hover:border-brand-500/40 hover:shadow-xl transition-all duration-500">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mb-5 border border-brand-100">
                        <i data-lucide="headphones" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Custom Fleksibel</h4>
                    <p class="text-slate-600 text-sm leading-relaxed">Bisa menyesuaikan ukuran, fungsi, dan branding sesuai kebutuhan bisnis.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="cta" class="relative py-24 overflow-hidden">
        <div class="absolute inset-0 lux-hero-bg"></div>
        <div class="absolute inset-0 bg-slate-950/85"></div>
        <div class="absolute inset-0 hero-dots"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 text-center text-white">
            <h2 class="font-display text-4xl md:text-5xl font-bold mb-6 reveal-item">Siap Punya Display Akrilik yang Rapi?</h2>
            <p class="text-slate-200 text-lg mb-10 max-w-3xl mx-auto reveal-item">Konsultasikan kebutuhan frame poster, rak brosur, rak kopi, dan display lainnya. Kami bantu dari desain sampai produksi.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center reveal-item">
                <a href="https://wa.me/6285385136547" class="px-8 py-4 rounded-full bg-brand-500 text-white font-bold shadow-xl shadow-brand-500/30 hover:bg-brand-600 transition-all">
                    Hubungi Kami
                </a>
                <a href="{{ route('kategori') }}" class="px-8 py-4 rounded-full border border-white/30 text-white font-semibold backdrop-blur-sm hover:bg-white/10 transition-all">
                    Lihat Katalog
                </a>
            </div>
        </div>
    </section>
@endsection

@section('custom_script')
<script>
        lucide.createIcons();

        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (!nav) return;
            if (window.scrollY > 50) {
                nav.classList.add('glass-nav', 'shadow-md', 'py-0');
                nav.classList.remove('py-6');
            } else {
                nav.classList.remove('glass-nav', 'shadow-md', 'py-0');
                nav.classList.add('py-6');
            }
        });

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    const childLines = entry.target.querySelectorAll('.reveal-line');
                    childLines.forEach(line => line.classList.add('active'));
                    obs.unobserve(entry.target);
                }
            });
        }, {
            root: null,
            rootMargin: '0px',
            threshold: 0.12
        });

        document.querySelectorAll('.reveal-item').forEach((el) => {
            observer.observe(el);
        });
    </script>
@endsection
