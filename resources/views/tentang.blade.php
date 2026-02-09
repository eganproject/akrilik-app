@extends('layouts.landing', ['title' => 'Tentang MGA'])

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
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'pop-in': 'popIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        },
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        popIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'scale(0.95)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'scale(1)'
                            }
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
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .category-item.active {
            background-color: #f0f9ff;
            color: #21939F;
            border-right: 3px solid #21939F;
        }

        .category-item.active svg {
            opacity: 1 !important;
        }

        /* Smooth reveal for content */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
@endsection

@section('content')
    @include('partials.headerSection', [
        'title_1' => 'Tentang',
        'title_2' => 'Media Gudang Acc',
        'description' => 'Solusi Advertising UMKM',
    ])

    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Image Composition -->
                <div class="relative reveal-on-scroll">
                    <div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-2xl shadow-slate-200">
                        <img src="{{ asset('public/assets/images/about.jpeg') }}"
                            alt="MGA Office Team" class="w-full h-auto object-cover">
                    </div>
                    <!-- Floater Stats -->
                    <div
                        class="absolute -bottom-10 -right-10 bg-white p-8 rounded-3xl shadow-xl border border-slate-100 z-20 hidden md:block">
                        <p class="text-slate-500 text-sm font-medium mb-1">Pengalaman</p>
                        <p class="text-4xl font-bold text-brand-600 font-display">5+ Tahun</p>
                    </div>
                    <!-- Decorative Dots -->
                    <div
                        class="absolute -top-4 -left-4 w-24 h-24 bg-[radial-gradient(#21939F_2px,transparent_2px)] [background-size:12px_12px] opacity-30">
                    </div>
                </div>

                <!-- Text Content -->
                <div class="reveal-on-scroll" style="transition-delay: 200ms;">
                    <h2 class="text-brand-600 font-bold tracking-widest uppercase text-sm mb-4">SIAPA KAMI</h2>
                    <h3 class="font-display text-3xl md:text-4xl font-bold text-slate-900 mb-6 leading-tight">Tumbuh Bersama MGA !</h3>
                    <div class="space-y-4 text-slate-600 text-lg leading-relaxed">
                        <p>
                            Media Gudang Acc adalah perusahaan yang fokus menyediakan beragam aksesoris pemasaran
                            berkualitas di Indonesia. Kami berdedikasi menjadi mitra terpercaya bagi bisnis-bisnis di
                            berbagai sektor yang membutuhkan produk pemasaran yang andal.
                        </p>
                        <p>
                            Dengan pengalaman dan dedikasi tinggi, kami telah mengembangkan jaringan distribusi yang luas,
                            menjangkau toko-toko di berbagai wilayah di Indonesia.
                        </p>
                        <p>
                            Sebagai distributor terpercaya, Media Gudang Acc memberikan pelayanan yang profesional dan
                            produk-produk yang teruji kualitasnya.
                        </p>
                        <p>
                            Kami berkomitmen untuk terus mendukung para pelaku bisnis dengan menyediakan aksesoris pemasaran
                            yang membantu mereka mengembangkan dan memaksimalkan potensi bisnis.
                        </p>
                        <p>
                            Kami memahami kebutuhan pasar yang terus berkembang, sehingga kami terus berinovasi untuk
                            menawarkan produk yang relevan dan memenuhi standar industri yang tinggi.
                        </p>
                    </div>
                    <div class="mt-8 pt-8 border-t border-slate-100 flex items-center gap-8">
                        <img src="{{ asset('public/assets/images/logo/logo.png') }}" alt="Signature"
                            class="h-10 opacity-50">
                        {{-- <div>
                            <p class="text-slate-900 font-bold">Direksi MGA</p>
                            <p class="text-slate-500 text-xs">Founder & CEO</p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    {{-- <section class="py-20 bg-brand-900 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-white/10">
                <div class="reveal-on-scroll">
                    <h4 class="text-4xl md:text-5xl font-display font-bold text-white mb-2">500+</h4>
                    <p class="text-brand-200 text-sm font-medium uppercase tracking-wide">Proyek Selesai</p>
                </div>
                <div class="reveal-on-scroll" style="transition-delay: 100ms;">
                    <h4 class="text-4xl md:text-5xl font-display font-bold text-white mb-2">50+</h4>
                    <p class="text-brand-200 text-sm font-medium uppercase tracking-wide">Kota Terjangkau</p>
                </div>
                <div class="reveal-on-scroll" style="transition-delay: 200ms;">
                    <h4 class="text-4xl md:text-5xl font-display font-bold text-white mb-2">100%</h4>
                    <p class="text-brand-200 text-sm font-medium uppercase tracking-wide">Kepuasan Klien</p>
                </div>
                <div class="reveal-on-scroll" style="transition-delay: 300ms;">
                    <h4 class="text-4xl md:text-5xl font-display font-bold text-white mb-2">24/7</h4>
                    <p class="text-brand-200 text-sm font-medium uppercase tracking-wide">Dukungan Teknis</p>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- CTA SECTION -->
    <section class="py-24 bg-white relative overflow-hidden border-t border-slate-100">
        <div class="max-w-5xl mx-auto px-4 relative z-10 text-center reveal-on-scroll">
            <h2 class="font-display text-4xl md:text-5xl font-bold text-slate-900 mb-6">Siap Meningkatkan Bisnis Anda?</h2>
            <p class="text-slate-500 text-lg mb-10 max-w-2xl mx-auto">
                Konsultasikan kebutuhan display visual Anda dengan tim ahli kami hari ini. Dapatkan penawaran terbaik dan
                solusi yang tepat sasaran.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://wa.me/6289517506300" target="_blank"
                    class="px-8 py-4 bg-brand-600 text-white rounded-full font-bold hover:bg-brand-700 transition shadow-lg hover:shadow-brand-500/30 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.359-5.292c0-5.443 4.428-9.87 9.87-9.87 2.636 0 5.116 1.026 6.98 2.889a9.839 9.839 0 012.893 6.975c-.003 5.444-4.432 9.87-9.877 9.87"
                            fill-rule="evenodd" clip-rule="evenodd" />
                    </svg>
                    Hubungi via WhatsApp
                </a>
                <a href="/kategori"
                    class="px-8 py-4 bg-white border border-slate-200 text-slate-700 rounded-full font-bold hover:bg-slate-50 transition flex items-center justify-center gap-2">
                    Lihat Produk Kami
                </a>
            </div>
        </div>
    </section>
@endsection


@section('custom_script')
    <script>
        lucide.createIcons();

        // Data Produk Dummy (untuk Mega Menu)
        const productsData = {
            'interactive': [{
                name: 'MaxHub V6 Classic',
                img: 'monitor'
            }, {
                name: 'MaxHub V6 ViewPro',
                img: 'monitor'
            }, {
                name: 'Iceboard E2 Series',
                img: 'monitor'
            }, {
                name: 'Horion M5A',
                img: 'monitor'
            }, {
                name: 'Samsung Flip Pro',
                img: 'monitor'
            }, {
                name: 'LG One:Quick',
                img: 'monitor'
            }],
            'mobile': [{
                name: 'Portable LCD 43"',
                img: 'smartphone'
            }, {
                name: 'Portable LCD 55"',
                img: 'smartphone'
            }, {
                name: 'Foldable Signage',
                img: 'smartphone'
            }, {
                name: 'Battery Powered LCD',
                img: 'smartphone'
            }, {
                name: 'Outdoor Mobile Kiosk',
                img: 'smartphone'
            }, {
                name: 'Slimline Portable',
                img: 'smartphone'
            }],
            'signage': [{
                name: 'Wall Mount LCD',
                img: 'layout'
            }, {
                name: 'High Brightness LCD',
                img: 'layout'
            }, {
                name: 'Stretched Bar LCD',
                img: 'layout'
            }, {
                name: 'Double Sided Screen',
                img: 'layout'
            }, {
                name: 'Menu Board Display',
                img: 'layout'
            }, {
                name: 'Video Wall LCD',
                img: 'layout'
            }],
            'videotron': [{
                name: 'Indoor P1.8 LED',
                img: 'grid-3x3'
            }, {
                name: 'Indoor P2.5 LED',
                img: 'grid-3x3'
            }, {
                name: 'Outdoor P3.9 LED',
                img: 'grid-3x3'
            }, {
                name: 'Outdoor P5 LED',
                img: 'grid-3x3'
            }, {
                name: 'Transparent LED',
                img: 'grid-3x3'
            }, {
                name: 'Flexible LED Module',
                img: 'grid-3x3'
            }],
            'kiosk': [{
                name: 'Self Order Kiosk',
                img: 'mouse-pointer-click'
            }, {
                name: 'Payment Kiosk',
                img: 'mouse-pointer-click'
            }, {
                name: 'Information Kiosk',
                img: 'mouse-pointer-click'
            }, {
                name: 'Ticket Dispenser',
                img: 'mouse-pointer-click'
            }, {
                name: 'Check-in Kiosk',
                img: 'mouse-pointer-click'
            }, {
                name: 'Directory Kiosk',
                img: 'mouse-pointer-click'
            }],
            'access': [{
                name: 'Standing Bracket',
                img: 'layers'
            }, {
                name: 'Wall Mount Bracket',
                img: 'layers'
            }, {
                name: 'Ceiling Mount',
                img: 'layers'
            }, {
                name: 'Video Wall Push-out',
                img: 'layers'
            }, {
                name: 'Mobile Cart Stand',
                img: 'layers'
            }, {
                name: 'HDMI/VGA Cables',
                img: 'layers'
            }]
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
            // override ke handler navbar dinamis
            const key = document.querySelector('.category-item')?.dataset.navCategory || catId;
            if (window.__navShowCategory) {
                window.__navShowCategory(key);
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            showCategory('interactive');
        });

        // Navbar Scroll Effect
        function updateNavbar() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('glass-nav', 'shadow-md', 'py-0');
                nav.classList.remove('py-6');
            } else {
                nav.classList.remove('glass-nav', 'shadow-md', 'py-0');
                nav.classList.add('py-6');
            }
        }

        window.addEventListener('scroll', updateNavbar);
        window.addEventListener('load', updateNavbar);

        // Scroll Reveal Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
            observer.observe(el);
        });
    </script>
@endsection
