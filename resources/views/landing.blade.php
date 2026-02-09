@extends('layouts.landing', ['title' => 'Media Gudang Acc'])


@section('custom_style')
<script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eefcfd',
                            100: '#d0f6f9',
                            200: '#a6edf2',
                            300: '#6edfe6',
                            400: '#33c6d1',
                            500: '#21939F', // Primary Teal
                            600: '#197682',
                            700: '#16606a',
                            800: '#174e57',
                            900: '#16424a',
                            dark: '#0f172a'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 3s infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'slide-in-right': 'slideInRight 1s ease-out forwards',
                        'spin-slow': 'spin 12s linear infinite',
                        'pulse-glow': 'pulseGlow 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'silhouette-glow': 'silhouetteGlow 4s ease-in-out infinite',
                        'pop-in': 'popIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideInRight: {
                            '0%': { opacity: '0', transform: 'translateX(50px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        },
                        pulseGlow: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '.5' }
                        },
                        silhouetteGlow: {
                            '0%, 100%': { opacity: '0.4', boxShadow: '0 0 2px rgba(33, 147, 159, 0)' },
                            '50%': { opacity: '1', boxShadow: '0 0 15px rgba(33, 147, 159, 0.8)' }
                        },
                        popIn: {
                            '0%': { opacity: '0', transform: 'scale(0.95)' },
                            '100%': { opacity: '1', transform: 'scale(1)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-nav {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        
        .hero-video-wrapper {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: 0; pointer-events: none; 
        }
        .hero-video-local {
            width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;
        }

        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        @keyframes marquee-text { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        
        .logo-marquee-container {
            width: 100%; overflow: hidden; position: relative;
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
        .logo-marquee-content { display: flex; width: max-content; animation: marquee 60s linear infinite; }
        .logo-marquee-content:hover { animation-play-state: paused; }
        .logo-marquee-content img { transform: scale(1.08); transform-origin: center; }

        .text-marquee-wrapper {
            position: absolute; top: 10%; left: 0; width: 100%; overflow: hidden; opacity: 0.03; z-index: 0; pointer-events: none;
            font-family: 'Space Grotesk', sans-serif; font-weight: 800; font-size: 8rem; line-height: 1; white-space: nowrap; color: #0f172a;
        }
        .text-marquee-content { display: inline-block; animation: marquee-text 40s linear infinite; }

        .reveal-item { opacity: 0; transform: translateY(40px); transition: all 1s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal-item.active { opacity: 1; transform: translateY(0); }

        .reveal-line { width: 0; transition: width 1.5s ease-out; }
        .reveal-line.active { width: 100%; }
        
        /* Animated Borders for Product Cards */
        .card-border-top { position: absolute; top: 0; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, transparent, #21939F, transparent); transition: width 0.6s ease-out; z-index: 20; }
        .card-border-right { position: absolute; top: 0; right: 0; width: 2px; height: 0; background: linear-gradient(180deg, transparent, #21939F, transparent); transition: height 0.6s ease-out 0.6s; z-index: 20; }
        .card-border-bottom { position: absolute; bottom: 0; right: 0; width: 0; height: 2px; background: linear-gradient(270deg, transparent, #21939F, transparent); transition: width 0.6s ease-out 1.2s; z-index: 20; }
        .card-border-left { position: absolute; bottom: 0; left: 0; width: 2px; height: 0; background: linear-gradient(0deg, transparent, #21939F, transparent); transition: height 0.6s ease-out 1.8s; z-index: 20; }

        .reveal-item.active .card-border-top { width: 100%; }
        .reveal-item.active .card-border-right { height: 100%; }
        .reveal-item.active .card-border-bottom { width: 100%; }
        .reveal-item.active .card-border-left { height: 100%; }

        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
        
        /* Mega Menu Styles */
        .category-item.active {
            background-color: #f0f9ff;
            color: #21939F;
            border-right: 3px solid #21939F;
        }
        /* Memastikan icon panah muncul saat aktif */
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
    <section id="home" class="relative pt-32 lg:pt-48 overflow-hidden min-h-screen flex flex-col justify-between">
        <div class="hero-video-wrapper">
            <!-- Video Lokal (Ganti src dengan path file Anda) -->
            <video autoplay muted loop playsinline class="hero-video-local">
                <source src="{{ asset('public/assets/videos/background.mp4') }}" type="video/mp4">
                <!-- Fallback Online -->
                <source src="https://assets.mixkit.co/videos/preview/mixkit-digital-animation-of-blue-lines-996-large.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-slate-900/40"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-slate-900/20"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full flex-grow flex items-center justify-center">
            <div class="flex flex-col items-center justify-center text-center max-w-5xl mx-auto">
                <div class="text-white space-y-8 animate-fade-in-up flex flex-col items-center">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        <span class="text-sm font-medium tracking-wide">Penunjang Promosi Efektif</span>
                    </div>
                    <h1 class="font-display text-6xl lg:text-8xl font-bold leading-none tracking-tight drop-shadow-lg">
                        Pikat Perhatian  <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 via-cyan-200 to-white drop-shadow-sm">Pelanggan</span>
                    </h1>
                    <p class="text-xl text-slate-100 max-w-2xl leading-relaxed font-light drop-shadow-md">
                        Media promosi fleksibel. Mudah dipasang, mudah dipindah, hasil maksimal.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4 w-full justify-center">
                        <a href="https://wa.me/6289517506300" class="px-8 py-4 bg-white text-brand-900 rounded-full font-bold hover:bg-slate-200 transition shadow-xl text-center flex items-center justify-center gap-2">Hubungi Kami</a>
                        <a href="{{ route('kategori') }}" class="px-8 py-4 bg-white/10 border border-white/30 text-white rounded-full font-semibold hover:bg-white/20 transition backdrop-blur-sm text-center flex items-center justify-center gap-2">Lihat Katalog <i data-lucide="download" class="w-4 h-4"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative z-20 w-full pb-12 pt-8">
            <div class="max-w-full mx-auto text-center">
                <p class="text-xs font-bold text-slate-300 uppercase tracking-[0.3em] mb-8 opacity-70">Dipercaya Oleh </p>
                <div class="logo-marquee-container">
                    <div class="logo-marquee-content items-center transition-opacity duration-500">
                        <div class="flex gap-16 items-center shrink-0 pr-16">
                            <img src="{{ asset('public/assets/brand_partner/1.png') }}" alt="Partner 1" class="h-12 md:h-16 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/2.png') }}" alt="Partner 2" class="h-12 md:h-20 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/3.png') }}" alt="Partner 3" class="h-12 md:h-20 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/4.png') }}" alt="Partner 4" class="h-10 md:h-14 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/5.png') }}" alt="Partner 5" class="h-10 md:h-14 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/6.png') }}" alt="Partner 6" class="h-10 md:h-14 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/7.png') }}" alt="Partner 7" class="h-12 md:h-16 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/8.png') }}" alt="Partner 8" class="h-12 md:h-16 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/9.png') }}" alt="Partner 9" class="h-12 md:h-16 object-contain shrink-0">
                        </div>
                        <!-- Duplikat untuk Marquee Loop -->
                        <div class="flex gap-16 items-center shrink-0 pr-16">
                            <img src="{{ asset('public/assets/brand_partner/1.png') }}" alt="Partner 1" class="h-12 md:h-16 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/2.png') }}" alt="Partner 2" class="h-12 md:h-20 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/3.png') }}" alt="Partner 3" class="h-12 md:h-20 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/4.png') }}" alt="Partner 4" class="h-10 md:h-14 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/5.png') }}" alt="Partner 5" class="h-10 md:h-14 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/6.png') }}" alt="Partner 6" class="h-10 md:h-14 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/7.png') }}" alt="Partner 7" class="h-12 md:h-16 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/8.png') }}" alt="Partner 8" class="h-12 md:h-16 object-contain shrink-0">
                            <img src="{{ asset('public/assets/brand_partner/9.png') }}" alt="Partner 9" class="h-12 md:h-16 object-contain shrink-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-24 bg-slate-50 relative overflow-hidden flex items-center">
        <!-- Background Elements -->
        <div class="text-marquee-wrapper">
            <div class="text-marquee-content">TRIPOD BANNER • STAND DISPLAY • ROLL UP BANNER • SLIM LIGHTBOX • TEMPAT BROSUR • TRIPOD BANNER • STAND DISPLAY • ROLL UP BANNER • SLIM LIGHTBOX • TEMPAT BROSUR •</div>
            <div class="text-marquee-content">TRIPOD BANNER • STAND DISPLAY • ROLL UP BANNER • SLIM LIGHTBOX • TEMPAT BROSUR • TRIPOD BANNER • STAND DISPLAY • ROLL UP BANNER • SLIM LIGHTBOX • TEMPAT BROSUR •</div>
        </div>
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-96 h-96 bg-brand-200/30 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-200/30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-20 items-center">
                <!-- KOLOM KIRI -->
                <div class="lg:col-span-4 text-left reveal-item">
                    <h2 class="text-brand-600 font-bold tracking-[0.2em] uppercase text-sm mb-4 flex items-center gap-2">
                        <span class="w-8 h-[2px] bg-brand-600 inline-block"></span> KATEGORI
                    </h2>
                    <h3 class="font-display text-4xl md:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                        Pilihan <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-purple-500">Unggulan.</span>
                    </h3>
                    <p class="text-slate-600 text-lg leading-relaxed mb-8">
                        Jelajahi berbagai solusi visual display yang dirancang dengan estetika tinggi untuk memaksimalkan dampak komunikasi bisnis Anda.
                    </p>
                    <a href="/kategori" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-brand-600 rounded-full hover:bg-brand-700 hover:shadow-lg hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 group">
                        Lihat Semua Kategori
                        <i data-lucide="arrow-right" class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1"></i>
                    </a>
                    <div class="mt-12 h-[2px] bg-slate-200 w-full relative overflow-visible rounded-full max-w-[200px]">
                         <div class="reveal-line absolute top-0 left-0 h-full bg-gradient-to-r from-brand-500 via-purple-400 to-brand-500 animate-silhouette-glow shadow-brand-500/50"></div>
                    </div>
                </div>

                <!-- KOLOM KANAN: 3 Card Estetik -->
                <div class="lg:col-span-8">
                    <div class="grid md:grid-cols-3 gap-6">
                        @forelse(($featuredCategories ?? []) as $i => $feat)
                            @php
                                $delay = ($i+1) * 100;
                                $cat = $feat->category;
                            @endphp
                            <div class="reveal-item delay-{{ $delay }} group relative">
                                <div class="relative bg-white/60 backdrop-blur-md border border-white/80 h-auto md:h-[28rem] min-h-[22rem] rounded-xl sm:rounded-2xl md:rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden transition-all duration-500 hover:shadow-brand-500/20 hover:-translate-y-2 flex flex-col items-center justify-between p-5 sm:p-6 pb-7 sm:pb-8">
                                    <div class="absolute inset-0 bg-gradient-to-b from-brand-50/50 to-transparent opacity-50 group-hover:opacity-100 transition-opacity"></div>
                                    <div class="relative w-full flex-grow flex items-center justify-center mt-2 sm:mt-4">
                                        <div class="absolute w-32 h-32 sm:w-36 sm:h-36 md:w-40 md:h-40 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-700"></div>
                                        @if($cat?->image)
                                            <img src="{{ Storage::disk('public')->url($cat->image) }}" alt="{{ $cat->name }}" class="relative z-10 w-32 h-32 sm:w-36 sm:h-36 md:w-40 md:h-40 object-contain drop-shadow-xl animate-float">
                                        @else
                                            <div class="relative z-10 w-28 h-28 sm:w-32 sm:h-32 md:w-32 md:h-32 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center font-bold uppercase animate-float">{{ strtoupper(substr($cat->name ?? 'X',0,2)) }}</div>
                                        @endif
                                    </div>
                                    <div class="text-center relative z-10 w-full">
                                        <h4 class="text-lg sm:text-xl font-display font-bold text-slate-900 mb-4 group-hover:text-brand-600 transition-colors">{{ $cat?->name ?? 'Kategori' }}</h4>
                                        @if($cat)
                                            <a href="{{ route('kategori.show', $cat->slug) }}" class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white border border-slate-200 text-slate-400 flex items-center justify-center mx-auto hover:bg-brand-600 hover:text-white hover:border-brand-600 transition-all duration-300 shadow-sm group-hover:scale-110"><i data-lucide="arrow-up-right" class="w-5 h-5"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-slate-500 text-sm">Belum ada kategori unggulan yang dipilih.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us (Mengapa MGA?) -->
    <section id="services" class="py-32 bg-white relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000008_1px,transparent_1px),linear-gradient(to_bottom,#00000008_1px,transparent_1px)] bg-[size:32px_32px]"></div>
            <div class="absolute inset-0 bg-radial-gradient from-transparent to-white"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-start mb-20">
                <div class="reveal-item">
                    <h2 class="text-brand-600 font-bold tracking-[0.2em] uppercase text-sm mb-4 flex items-center gap-2">
                        <span class="w-8 h-[2px] bg-brand-600 inline-block"></span> MENGAPA MGA?
                    </h2>
                    <h3 class="font-display text-4xl md:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                        Rasakan <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-cyan-500">Masa Depan Visual.</span>
                    </h3>
                    <p class="text-slate-600 text-lg leading-relaxed max-w-lg">
                        Kami bukan sekadar vendor. Kami adalah arsitek pengalaman digital Anda yang menggabungkan estetika, teknologi, dan keandalan sistem.
                    </p>
                    <div class="mt-8 h-[2px] bg-slate-100 w-full relative overflow-visible rounded-full">
                         <div class="reveal-line absolute top-0 left-0 h-full bg-gradient-to-r from-brand-500 via-cyan-400 to-brand-500 animate-silhouette-glow shadow-brand-500/50"></div>
                    </div>
                </div>
                <div class="reveal-item delay-200 relative hidden lg:block">
                     <div class="relative w-full aspect-video bg-white rounded-2xl border border-slate-200 shadow-2xl shadow-slate-200/50 overflow-hidden group">
                         <div class="absolute inset-0 flex items-center justify-center">
                             <div class="relative">
                                 <div class="absolute inset-0 bg-brand-500/10 blur-3xl rounded-full animate-pulse-glow"></div>
                                 <i data-lucide="codesandbox" class="w-24 h-24 text-brand-500 relative z-10 animate-float"></i>
                             </div>
                         </div>
                         <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-brand-500 to-transparent translate-x-[-100%] animate-[scanline_3s_linear_infinite]"></div>
                     </div>
                </div>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Features -->
                <div class="reveal-item delay-100 group relative p-8 bg-white border border-slate-200 rounded-3xl hover:border-brand-500/50 hover:shadow-xl hover:shadow-brand-500/10 transition-all duration-500 overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-0 bg-brand-500 transition-all duration-700 group-hover:h-full"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 border border-brand-100"><i data-lucide="settings" class="w-7 h-7"></i></div>
                        <h4 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-brand-600 transition-colors">Instalasi & Integrasi</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">Pemasangan presisi oleh tim tersertifikasi. Kabel rapi, sistem terkalibrasi, siap pakai tanpa kendala teknis.</p>
                    </div>
                </div>
                <div class="reveal-item delay-200 group relative p-8 bg-white border border-slate-200 rounded-3xl hover:border-purple-500/50 hover:shadow-xl hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-0 bg-purple-500 transition-all duration-700 group-hover:h-full"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 border border-purple-100"><i data-lucide="shield-check" class="w-7 h-7"></i></div>
                        <h4 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-purple-600 transition-colors">Quality Control Ketat</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">Zero-dead-pixel policy. Setiap unit melewati 48 jam stress-test sebelum pengiriman untuk durabilitas maksimal.</p>
                    </div>
                </div>
                <div class="reveal-item delay-300 group relative p-8 bg-white border border-slate-200 rounded-3xl hover:border-orange-500/50 hover:shadow-xl hover:shadow-orange-500/10 transition-all duration-500 overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-0 bg-orange-500 transition-all duration-700 group-hover:h-full"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 border border-orange-100"><i data-lucide="headphones" class="w-7 h-7"></i></div>
                        <h4 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-orange-600 transition-colors">Layanan Purna Jual</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">Dukungan teknis responsif 24/7 dan garansi resmi. Kami memastikan investasi visual Anda selalu beroperasi prima.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Info Section (Simple & Clean - Horizontal Bar) -->
    <section id="contact-info" class="py-24 relative overflow-hidden bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Grid 3 Kolom untuk Info - Tanpa Card Container -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 divide-y md:divide-y-0 md:divide-x divide-slate-200">
                
                <!-- Free Shipping (Vertical Layout) -->
                <div class="reveal-item group flex flex-col items-center text-center gap-4 p-6 md:px-8">
                    <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-full text-brand-500 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="truck" class="w-9 h-9"></i>
                    </div>
                    <div>
                        <h4 class="text-slate-900 font-display font-bold text-xl mb-2 group-hover:text-brand-600 transition-colors">Gratis Ongkir</h4>
                        <p class="text-slate-500 text-sm leading-relaxed max-w-xs mx-auto">
                            Gratis Ongkir untuk daerah <br> JABODETABEK <br> S&K Berlaku.
                        </p>
                    </div>
                </div>

                <!-- Support Center (Vertical Layout) -->
                <div class="reveal-item delay-100 group flex flex-col items-center text-center gap-4 p-6 md:px-8">
                    <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-full text-purple-500 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="headset" class="w-9 h-9"></i>
                    </div>
                    <div>
                        <h4 class="text-slate-900 font-display font-bold text-xl mb-2 group-hover:text-purple-600 transition-colors">Pusat Bantuan</h4>
                        <p class="text-slate-500 text-sm leading-relaxed max-w-xs mx-auto">
                            Dukungan teknis responsif <br>08.00 - 23.00 WIB.
                        </p>
                    </div>
                </div>

                <!-- Email Us (Vertical Layout) -->
                <div class="reveal-item delay-200 group flex flex-col items-center text-center gap-4 p-6 md:px-8">
                    <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-full text-orange-500 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="mail" class="w-9 h-9"></i>
                    </div>
                    <div>
                        <h4 class="text-slate-900 font-display font-bold text-xl mb-2 group-hover:text-orange-600 transition-colors">Email Kami</h4>
                        <p class="text-slate-500 text-sm leading-relaxed max-w-xs mx-auto">
                            Hubungi kami di <br> sales@mga-advertising.co.id
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


@section('custom_script')
 <script>
        lucide.createIcons();

        // Data Produk Dummy
        const productsData = {
            'interactive': [{
                    name: 'MaxHub V6 Classic',
                    img: 'monitor'
                },
                {
                    name: 'MaxHub V6 ViewPro',
                    img: 'monitor'
                },
                {
                    name: 'Iceboard E2 Series',
                    img: 'monitor'
                },
                {
                    name: 'Horion M5A',
                    img: 'monitor'
                },
                {
                    name: 'Samsung Flip Pro',
                    img: 'monitor'
                },
                {
                    name: 'LG One:Quick',
                    img: 'monitor'
                }
            ],
            'mobile': [{
                    name: 'Portable LCD 43"',
                    img: 'smartphone'
                },
                {
                    name: 'Portable LCD 55"',
                    img: 'smartphone'
                },
                {
                    name: 'Foldable Signage',
                    img: 'smartphone'
                },
                {
                    name: 'Battery Powered LCD',
                    img: 'smartphone'
                },
                {
                    name: 'Outdoor Mobile Kiosk',
                    img: 'smartphone'
                },
                {
                    name: 'Slimline Portable',
                    img: 'smartphone'
                }
            ],
            'signage': [{
                    name: 'Wall Mount LCD',
                    img: 'layout'
                },
                {
                    name: 'High Brightness LCD',
                    img: 'layout'
                },
                {
                    name: 'Stretched Bar LCD',
                    img: 'layout'
                },
                {
                    name: 'Double Sided Screen',
                    img: 'layout'
                },
                {
                    name: 'Menu Board Display',
                    img: 'layout'
                },
                {
                    name: 'Video Wall LCD',
                    img: 'layout'
                }
            ],
            'videotron': [{
                    name: 'Indoor P1.8 LED',
                    img: 'grid-3x3'
                },
                {
                    name: 'Indoor P2.5 LED',
                    img: 'grid-3x3'
                },
                {
                    name: 'Outdoor P3.9 LED',
                    img: 'grid-3x3'
                },
                {
                    name: 'Outdoor P5 LED',
                    img: 'grid-3x3'
                },
                {
                    name: 'Transparent LED',
                    img: 'grid-3x3'
                },
                {
                    name: 'Flexible LED Module',
                    img: 'grid-3x3'
                }
            ],
            'kiosk': [{
                    name: 'Self Order Kiosk',
                    img: 'mouse-pointer-click'
                },
                {
                    name: 'Payment Kiosk',
                    img: 'mouse-pointer-click'
                },
                {
                    name: 'Information Kiosk',
                    img: 'mouse-pointer-click'
                },
                {
                    name: 'Ticket Dispenser',
                    img: 'mouse-pointer-click'
                },
                {
                    name: 'Check-in Kiosk',
                    img: 'mouse-pointer-click'
                },
                {
                    name: 'Directory Kiosk',
                    img: 'mouse-pointer-click'
                }
            ],
            'access': [{
                    name: 'Standing Bracket',
                    img: 'layers'
                },
                {
                    name: 'Wall Mount Bracket',
                    img: 'layers'
                },
                {
                    name: 'Ceiling Mount',
                    img: 'layers'
                },
                {
                    name: 'Video Wall Push-out',
                    img: 'layers'
                },
                {
                    name: 'Mobile Cart Stand',
                    img: 'layers'
                },
                {
                    name: 'HDMI/VGA Cables',
                    img: 'layers'
                }
            ]
        };

        const categoryTitles = {
            'interactive': 'Interactive Panel',
            'mobile': 'Mobile Signage',
            'signage': 'Digital Signage',
            'videotron': 'Videotron LED',
            'kiosk': 'Kiosk System',
            'access': 'Aksesoris'
        };

        function showCategory(catId) {
            // Update Active State di Menu Kiri
            document.querySelectorAll('.category-item').forEach(el => {
                el.classList.remove('active', 'bg-slate-50', 'text-brand-600', 'border-r-4', 'border-brand-500');
                el.classList.add('text-slate-600');
                // Removed redundant icon manipulation as it's handled by CSS
            });

            // Highlight item yang dihover
            const activeBtn = document.querySelector(`button[data-category="${catId}"]`);
            if (activeBtn) {
                activeBtn.classList.add('active', 'bg-slate-50', 'text-brand-600');
                activeBtn.classList.remove('text-slate-600');
            }

            // Update Judul Kanan
            document.getElementById('mega-menu-title').innerText = categoryTitles[catId];

            // Render Produk di Grid Kanan
            const grid = document.getElementById('mega-menu-grid');
            grid.innerHTML = ''; // Clear previous

            const items = productsData[catId];
            if (items) {
                items.forEach((prod, index) => {
                    // Animasi delay bertingkat
                    const delayClass = `delay-[${index * 75}ms]`;
                    const html = `
                        <a href="#" class="group/prod block p-3 rounded-xl border border-slate-100 hover:border-brand-200 hover:shadow-md transition-all duration-300 animate-pop-in" style="animation-delay: ${index * 50}ms">
                            <div class="h-24 bg-slate-50 rounded-lg flex items-center justify-center mb-3 group-hover/prod:bg-brand-50 transition-colors">
                                <i data-lucide="${prod.img}" class="w-8 h-8 text-slate-400 group-hover/prod:text-brand-500 transition-colors"></i>
                            </div>
                            <h6 class="text-xs font-bold text-slate-800 line-clamp-1 group-hover/prod:text-brand-600 transition-colors">${prod.name}</h6>
                            <p class="text-[10px] text-slate-400 mt-1">Lihat Detail</p>
                        </a>
                    `;
                    grid.innerHTML += html;
                });
                lucide.createIcons(); // Refresh icons for new elements
            }
        }

        // Override handler lama supaya pakai data dinamis dari partial navbar
        window.showCategory = function (catId) {
            const key = document.querySelector('.category-item')?.dataset.navCategory || catId;
            if (window.__navShowCategory) {
                window.__navShowCategory(key);
            }
        };

        // Initialize First Category (gunakan handler baru)
        window.addEventListener('DOMContentLoaded', () => {
            showCategory('interactive');
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('glass-nav', 'shadow-md', 'py-0');
                nav.classList.remove('py-6');
            } else {
                nav.classList.remove('glass-nav', 'shadow-md', 'py-0');
                nav.classList.add('py-6');
            }
        });
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    const childLines = entry.target.querySelectorAll('.reveal-line');
                    childLines.forEach(line => line.classList.add('active'));
                    observer.unobserve(entry.target);
                }
            });
        }, {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        });
        document.querySelectorAll('.reveal-item').forEach((el) => {
            observer.observe(el);
        });
    </script>
@endsection
