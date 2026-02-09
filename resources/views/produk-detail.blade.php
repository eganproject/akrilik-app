@extends('layouts.landing', ['title' => $product->name ?? 'Produk'])

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
                        500: '#21939F',
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
                        '0%, 100%': { transform: 'translateY(0)' },
                        '50%': { transform: 'translateY(-20px)' },
                    },
                    fadeInUp: {
                        '0%': { opacity: '0', transform: 'translateY(20px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' },
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
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>
@endsection

@section('content')
    @include('partials.headerSection', [
        'title_1' => 'Produk',
        'title_2' => $product->name ?? '',
        'description' => $product->excerpt ?? ''
    ])

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] items-start">
            <!-- Gallery -->
            <div class="rounded-3xl p-4 md:p-6 relative overflow-visible">
                <div class="relative z-10 space-y-4">
                    @php
                        // Start with thumbnail (if any), then append product images (ordered by sort_order via relation)
                        $gallery = collect();
                        if ($product->thumbnail) {
                            $gallery->push((object)[
                                'file_path' => $product->thumbnail,
                                'alt_text'  => $product->name,
                            ]);
                        }
                        $gallery = $gallery->merge($product->images->values());
                        // Fallback to placeholder if still empty
                        $activeImage = $gallery->first();
                    @endphp
                    <div id="main-image-wrapper" class="group relative bg-white rounded-2xl border-2 border-slate-50 flex items-center justify-center overflow-hidden shadow-sm cursor-zoom-in w-full h-[320px] sm:h-[360px] md:h-[420px] lg:h-[451px] max-w-full mx-auto">
                        @if($activeImage?->file_path)
                            <img id="main-product-image" src="{{ Storage::disk('public')->url($activeImage->file_path) }}" alt="{{ $activeImage->alt_text ?? $product->name }}" class="w-full h-full object-contain transition-transform duration-300 ease-out">
                        @else
                            <div class="h-full w-full flex items-center justify-center text-3xl font-display text-slate-400">{{ strtoupper(substr($product->name,0,2)) }}</div>
                        @endif

                        <button type="button" id="prev-image" class="hidden md:flex absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/80 text-slate-600 border border-slate-200 shadow hover:bg-white hover:text-brand-600 transition items-center justify-center">
                            <i data-lucide="chevron-left" class="w-5 h-5"></i>
                        </button>
                        <button type="button" id="next-image" class="hidden md:flex absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/80 text-slate-600 border border-slate-200 shadow hover:bg-white hover:text-brand-600 transition items-center justify-center">
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </button>
                        <button type="button" id="fullscreen-image" class="absolute right-3 top-3 w-9 h-9 rounded-full bg-white/85 text-slate-700 border border-slate-200 shadow hover:bg-white hover:text-brand-600 transition flex items-center justify-center">
                            <i data-lucide="maximize-2" class="w-4 h-4"></i>
                        </button>
                    </div>

                    @if($gallery->count())
                        <div class="mt-2 flex flex-wrap gap-3 max-w-[500px] mx-auto justify-center sm:justify-start">
                            @foreach($gallery as $img)
                                <button class="thumb-btn w-[84px] h-[84px] sm:w-[92px] sm:h-[92px] md:w-[100px] md:h-[100px] rounded-xl border {{ $loop->first ? 'border-brand-300 ring-2 ring-brand-200' : 'border-slate-200' }} bg-white overflow-hidden" data-index="{{ $loop->index }}" data-src="{{ Storage::disk('public')->url($img->file_path) }}" data-alt="{{ $img->alt_text ?? $product->name }}">
                                    <img src="{{ Storage::disk('public')->url($img->file_path) }}" alt="{{ $img->alt_text ?? $product->name }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Detail -->
            <div class="space-y-6">
                <div class="flex items-start justify-between gap-4">
                    <div class="space-y-2">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 text-brand-700 text-xs font-semibold uppercase tracking-wide">
                            {{ $product->category?->name ?? 'Tanpa Kategori' }}
                        </div>
                        <h1 class="font-display text-3xl md:text-4xl font-bold text-slate-900 leading-tight">{{ $product->name }}</h1>
                        <p class="text-slate-500">{{ $product->excerpt }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                            <i data-lucide="box" class="w-5 h-5"></i>
                        </span>
                    </div>
                </div>

                @if($product->description)
                    <div class="prose prose-slate max-w-none leading-relaxed">
                        {!! $product->description !!}
                    </div>
                @endif

                <div class="flex flex-wrap gap-3 pt-2">
                    <a href="https://wa.me/6289517506300" class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-brand-600 text-white font-semibold shadow-lg shadow-brand-500/30 hover:bg-brand-700 transition">
                       <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.359-5.292c0-5.443 4.428-9.87 9.87-9.87 2.636 0 5.116 1.026 6.98 2.889a9.839 9.839 0 012.893 6.975c-.003 5.444-4.432 9.87-9.877 9.87" fill-rule="evenodd" clip-rule="evenodd"/></svg> Hubungi Kami
                    </a>
                    <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-full border border-slate-200 text-slate-700 hover:border-brand-300 hover:text-brand-700 transition bg-white">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom_script')
<script>
    lucide.createIcons();

    // Navbar scroll effect
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

    // Gallery navigation (thumbnails + arrows)
    const imgWrapper = document.getElementById('main-image-wrapper');
    const mainImg = document.getElementById('main-product-image');
    const thumbs = Array.from(document.querySelectorAll('.thumb-btn'));
    const prevBtn = document.getElementById('prev-image');
    const nextBtn = document.getElementById('next-image');
    const fullscreenBtn = document.getElementById('fullscreen-image');
    let currentIndex = thumbs.findIndex(btn => btn.classList.contains('ring-2'));
    if (currentIndex < 0) currentIndex = 0;

    function setActive(index) {
        if (!thumbs.length) return;
        currentIndex = (index + thumbs.length) % thumbs.length;
        thumbs.forEach((btn, i) => {
            btn.classList.toggle('border-brand-300', i === currentIndex);
            btn.classList.toggle('ring-2', i === currentIndex);
            btn.classList.toggle('ring-brand-200', i === currentIndex);
            btn.classList.toggle('border-slate-200', i !== currentIndex);
        });
        const activeBtn = thumbs[currentIndex];
        const src = activeBtn.dataset.src;
        const alt = activeBtn.dataset.alt || '';
        mainImg.src = src;
        mainImg.alt = alt;
    }

    thumbs.forEach((btn, idx) => btn.addEventListener('click', () => setActive(idx)));
    prevBtn?.addEventListener('click', () => setActive(currentIndex - 1));
    nextBtn?.addEventListener('click', () => setActive(currentIndex + 1));

    // Swipe support for mobile
    if (mainImg && ('ontouchstart' in window)) {
        let startX = 0;
        mainImg.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; }, { passive: true });
        mainImg.addEventListener('touchend', (e) => {
            const delta = e.changedTouches[0].clientX - startX;
            if (Math.abs(delta) > 40) {
                delta < 0 ? setActive(currentIndex + 1) : setActive(currentIndex - 1);
            }
        }, { passive: true });
    }

    // Main image hover zoom following cursor (skip when over controls / fullscreen)
    if (imgWrapper && mainImg) {
        const maxScale = 3;
        const isOnControl = (target) => target.closest('#prev-image') || target.closest('#next-image') || target.closest('#fullscreen-image');

        imgWrapper.addEventListener('mousemove', (e) => {
            if (isOnControl(e.target)) return; // jangan zoom saat hover controls
            if (document.fullscreenElement === imgWrapper) return; // jangan zoom saat fullscreen
            const rect = imgWrapper.getBoundingClientRect();
            const xPercent = ((e.clientX - rect.left) / rect.width) * 100;
            const yPercent = ((e.clientY - rect.top) / rect.height) * 100;
            mainImg.style.transformOrigin = `${xPercent}% ${yPercent}%`;
            mainImg.style.transform = `scale(${maxScale})`;
        });

        const resetZoom = () => {
            mainImg.style.transformOrigin = '50% 50%';
            mainImg.style.transform = 'scale(1)';
        };

        imgWrapper.addEventListener('mouseleave', resetZoom);
        document.addEventListener('fullscreenchange', () => {
            if (document.fullscreenElement !== imgWrapper) resetZoom();
        });
        ['mouseenter', 'mouseleave'].forEach(evt => {
            prevBtn?.addEventListener(evt, resetZoom);
            nextBtn?.addEventListener(evt, resetZoom);
            fullscreenBtn?.addEventListener(evt, resetZoom);
        });
    }

    // Fullscreen toggle for main image
    fullscreenBtn?.addEventListener('click', (e) => {
        e.preventDefault();
        if (!document.fullscreenElement) {
            imgWrapper.requestFullscreen?.();
        } else {
            document.exitFullscreen?.();
        }
    });

</script>
@endsection
