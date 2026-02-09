 <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 py-6" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center cursor-pointer">
                    <img src="{{ asset('public/assets/images/logo/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">
                </a>

                <!-- Menu Tengah (Updated with Mega Menu Split View) -->
                <div class="hidden lg:flex space-x-8 items-center absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <a href="/" class="text-slate-100 hover:text-white font-medium transition drop-shadow-md">Beranda</a>
                    
                    <!-- MENU PRODUK DENGAN SPLIT MEGA MENU -->
                    <div class="relative group">
                        <button class="text-slate-100 hover:text-white font-medium transition drop-shadow-md flex items-center gap-1 focus:outline-none py-4">
                            Produk 
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180"></i>
                        </button>

                        <!-- Split Mega Menu Card -->
                        <div class="absolute left-1/2 -translate-x-1/2 top-full pt-4 w-[850px] max-w-[90vw] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-4 z-50">
                            <div class="bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden flex h-[420px]">
                                
                                <!-- LEFT SIDE: Categories List -->
                                <div class="w-64 bg-slate-50 py-6 flex flex-col border-r border-slate-100">
                                    <h5 class="px-6 text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Kategori</h5>
                                    <div class="flex-1 overflow-y-auto">
                                        @forelse(($navCategories ?? collect()) as $loopCat)
                                            <button
                                                data-nav-category="cat-{{ $loopCat->id }}"
                                                data-name="{{ $loopCat->name }}"
                                                data-url="{{ route('kategori.show', $loopCat->slug) }}"
                                                onmouseover="window.__navShowCategory && __navShowCategory('cat-{{ $loopCat->id }}')"
                                                class="category-item {{ $loop->first ? 'active' : '' }} w-full text-left px-6 py-3 text-sm font-medium text-slate-600 hover:bg-white hover:text-brand-600 transition-all flex items-center justify-between group/cat">
                                                {{ $loopCat->name }}
                                                <i data-lucide="chevron-right" class="w-4 h-4 opacity-0 group-hover/cat:opacity-100 transition-opacity"></i>
                                            </button>
                                        @empty
                                            <div class="px-6 py-3 text-sm text-slate-400">Kategori belum tersedia.</div>
                                        @endforelse
                                    </div>
                                    
                                    <!-- Footer Link Left -->
                                    <div class="px-6 mt-4 pt-4 border-t border-slate-200">
                                        <a href="/kategori" class="text-xs text-brand-600 font-bold hover:underline flex items-center gap-1">
                                            Lihat Semua Kategori <i data-lucide="arrow-big-right-dash" class="w-3 h-3"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- RIGHT SIDE: Product Grid (Dynamic Content) -->
                                <div class="flex-1 p-8 bg-white overflow-y-auto">
                                    <div class="flex justify-between items-center mb-6">
                                        <h4 id="mega-menu-title" class="font-display font-bold text-xl text-slate-800">
                                            {{ ($navCategories ?? collect())->first()->name ?? 'Kategori' }}
                                        </h4>
                                        <a id="mega-menu-link" href="{{ ($navCategories ?? collect())->first() ? route('kategori.show', ($navCategories->first()->slug ?? '')) : '#' }}" class="text-xs font-semibold text-brand-500 hover:text-brand-700 flex items-center">
                                            Lihat Semua <i data-lucide="arrow-right" class="w-3 h-3 ml-1"></i>
                                        </a>
                                    </div>
                                    
                                    <!-- Grid Container -->
                                    <div id="mega-menu-grid" class="grid grid-cols-3 gap-4">
                                        @if(isset($navCategories) && $navCategories->isNotEmpty())
                                            @foreach($navCategories as $loopCat)
                                                <div class="mega-grid-group {{ $loop->first ? 'grid' : 'hidden' }} col-span-3 grid-cols-3 gap-4" data-nav-category="cat-{{ $loopCat->id }}">
                                                    @php
                                                        $prods = ($navProductsByCategory[$loopCat->id] ?? collect())->take(6);
                                                    @endphp
                                                    @forelse($prods as $prod)
                                                        <a href="{{ route('produk.show', $prod->slug) }}" class="group block rounded-xl border border-slate-100 hover:border-brand-200 shadow-sm hover:shadow-md transition overflow-hidden bg-white h-full">
                                                            <div class="aspect-[4/3] bg-white p-2 flex items-center justify-center overflow-hidden">
                                                                @if($prod->thumbnail)
                                                                    <img src="{{ Storage::disk('public')->url($prod->thumbnail) }}" alt="{{ $prod->name }}" class="w-full h-full object-contain transition">
                                                                @else
                                                                    <span class="text-sm text-slate-400">{{ $prod->name }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="p-3 space-y-1">
                                                                {{-- <p class="text-[11px] uppercase tracking-wide text-slate-400">{{ $loopCat->name }}</p> --}}
                                                                <h5 class="text-sm font-semibold text-slate-800 leading-tight line-clamp-2">{{ $prod->name }}</h5>
                                                                {{-- <p class="text-xs text-slate-500 line-clamp-2">{{ $prod->excerpt }}</p> --}}
                                                            </div>
                                                        </a>
                                                    @empty
                                                        <div class="text-sm text-slate-400">Belum ada produk.</div>
                                                    @endforelse
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-sm text-slate-400">Data kategori belum tersedia.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="/tentang" class="text-slate-100 hover:text-white font-medium transition drop-shadow-md">Tentang</a>
                </div>

                <!-- Tombol Kanan -->
                <div class="flex items-center gap-4">
                    <div class="lg:hidden flex items-center">
                        <button id="mobile-menu-btn"
                                aria-controls="mobile-menu"
                                aria-expanded="false"
                                class="text-white hover:text-brand-500 focus:outline-none p-1 rounded-md hover:bg-white/10">
                            <i data-lucide="menu" class="w-8 h-8"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden fixed inset-0 z-[90] bg-slate-900/70 backdrop-blur-sm overflow-y-auto">
        <div class="min-h-screen w-full flex items-start justify-center px-4 py-6 sm:py-10">
            <div class="w-full max-w-md bg-slate-900/95 border border-slate-800 rounded-2xl shadow-2xl overflow-hidden">
                <div class="flex items-center justify-between px-4 py-4 border-b border-slate-800">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('public/assets/images/logo/logo.png') }}" alt="Logo" class="h-8 w-auto object-contain">
                        <span class="text-sm font-semibold text-slate-200">Menu</span>
                    </div>
                    <button id="mobile-menu-close"
                            aria-label="Tutup menu"
                            class="text-slate-200 hover:text-white p-2 rounded-md hover:bg-white/10">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <div class="px-3 py-3 space-y-1">
                    <a href="{{ url('/') }}" class="flex items-center justify-between px-3 py-3.5 text-base font-medium text-slate-200 hover:bg-slate-800 hover:text-white rounded-xl transition">
                        <span>Beranda</span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-500"></i>
                    </a>
                    <a href="{{ route('kategori') ?? '/#products' }}" class="flex items-center justify-between px-3 py-3.5 text-base font-medium text-slate-200 hover:bg-slate-800 hover:text-white rounded-xl transition">
                        <span>Produk</span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-500"></i>
                    </a>
                    <a href="{{ url('/tentang') }}" class="flex items-center justify-between px-3 py-3.5 text-base font-medium text-slate-200 hover:bg-slate-800 hover:text-white rounded-xl transition">
                        <span>Tentang</span>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-500"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

<script>
    // Scoped handler khusus navbar agar tidak bentrok dengan fungsi bernama sama di halaman lain
    (function() {
        const buttons = document.querySelectorAll('.category-item');
        const grids = document.querySelectorAll('.mega-grid-group');
        const title = document.getElementById('mega-menu-title');
        const link = document.getElementById('mega-menu-link');

        function setCategory(key) {
            buttons.forEach(btn => {
                const active = btn.dataset.navCategory === key;
                btn.classList.toggle('active', active);
                if (active) {
                    title.textContent = btn.dataset.name || 'Kategori';
                    if (link) link.href = btn.dataset.url || '#';
                }
            });

            grids.forEach(grid => {
                const isActive = grid.dataset.navCategory === key;
                grid.classList.toggle('hidden', !isActive);
                grid.classList.toggle('grid', isActive);
            });
        }

        // ekspor ke global space dengan nama unik
        window.__navShowCategory = setCategory;

        document.addEventListener('DOMContentLoaded', () => {
            const firstActive = document.querySelector('.category-item.active') || document.querySelector('.category-item');
            if (firstActive) setCategory(firstActive.dataset.navCategory);

            // mobile menu toggle + body scroll lock
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileBtn && mobileMenu) {
                const toggleMenu = () => {
                    const isHidden = mobileMenu.classList.contains('hidden');
                    if (isHidden) {
                        mobileMenu.classList.remove('hidden');
                        mobileMenu.classList.add('block');
                    } else {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.classList.remove('block');
                    }
                    document.body.classList.toggle('overflow-hidden', isHidden);
                    mobileBtn.setAttribute('aria-expanded', String(isHidden));
                };
                mobileBtn.setAttribute('aria-expanded', 'false');
                mobileBtn.addEventListener('click', toggleMenu);

                const closeBtn = document.getElementById('mobile-menu-close');
                if (closeBtn) closeBtn.addEventListener('click', toggleMenu);

                // tutup menu saat link di-klik (mobile only)
                mobileMenu.querySelectorAll('a').forEach(a => {
                    a.addEventListener('click', () => {
                        if (!mobileMenu.classList.contains('hidden')) toggleMenu();
                    });
                });
            }
        });
    })();
</script>
