@extends('layouts.landing', ['title' => $category->name ?? 'Kategori'])



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
        
        .category-item.active {
            background-color: #f0f9ff;
            color: #21939F;
            border-right: 3px solid #21939F;
        }
        .category-item.active svg { opacity: 1 !important; }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>

@endsection


@section('content')
    @include('partials.headerSection', [
        'title_1' => 'Kategori',
        'title_2' => $category->name ?? '',
        'description' => $category->description ?? ''
    ])

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="w-full">
            
            <!-- Sorting/Display/Search Bar -->
            <form method="GET" class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
                <!-- Count -->
                <p class="text-sm text-slate-500 order-2 md:order-1">Menampilkan <span id="product-count" class="font-bold text-slate-900">{{ $products->total() }}</span> Produk</p>
                
                <!-- Search Bar -->
                <div class="order-1 md:order-2 w-full md:w-auto relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-brand-200 to-purple-200 rounded-full blur opacity-20 group-hover:opacity-50 transition duration-300"></div>
                    <input type="search" name="q" value="{{ $search }}" placeholder="Cari nama produk..." class="relative w-full md:w-80 pl-10 pr-4 py-2.5 rounded-full border border-slate-200 bg-white focus:ring-2 focus:ring-brand-100 focus:border-brand-500 outline-none transition-all text-sm placeholder:text-slate-400 shadow-sm">
                    <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 z-10"></i>
                </div>

                <div class="flex items-center gap-3 order-3">
                    <!-- Sort -->
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-slate-500">Urutkan:</span>
                        <select name="sort" data-auto-submit class="text-sm border border-slate-200 bg-white rounded-lg py-1.5 pl-3 pr-8 focus:ring-1 focus:ring-brand-500 cursor-pointer font-medium text-slate-700 hover:text-brand-600 shadow-sm">
                            <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="name_asc" {{ $sort === 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="name_desc" {{ $sort === 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                        </select>
                    </div>
                    <!-- Display Limit -->
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-slate-500">Tampilkan:</span>
                        <select name="per_page" data-auto-submit class="text-sm border border-slate-200 bg-white rounded-lg py-1.5 pl-3 pr-8 focus:ring-1 focus:ring-brand-500 cursor-pointer font-medium text-slate-700 hover:text-brand-600 shadow-sm">
                            @foreach([8,20,40,80,100] as $size)
                                <option value="{{ $size }}" {{ $perPage === $size ? 'selected' : '' }}>{{ $size }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <!-- Products Grid (With ID for filtering) -->
            <div id="products-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-8 gap-y-16">
                @forelse($products as $product)
                    <a href="{{ route('produk.show', $product->slug) }}" class="product-item group cursor-pointer block">
                        <div class="relative aspect-[4/3] flex items-center justify-center mb-6 overflow-visible">
                            @if($product->thumbnail)
                                <img src="{{ Storage::disk('public')->url($product->thumbnail) }}" alt="{{ $product->name }}" class="w-full h-full object-contain relative z-10 transition-transform duration-500 group-hover:scale-110 drop-shadow-xl">
                            @else
                                <div class="w-full h-full bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center text-slate-400 text-sm font-semibold">{{ strtoupper(substr($product->name, 0, 2)) }}</div>
                            @endif
                        </div>
                        <div class="text-center px-2">
                            <h3 class="font-display font-bold text-slate-900 text-lg leading-tight group-hover:text-brand-600 transition-colors line-clamp-2">{{ $product->name }}</h3>
                            <p class="mt-3 text-sm font-medium text-slate-400 flex items-center justify-center gap-1 group-hover:text-brand-600 transition-colors">
                                Lihat Detail Produk <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-4 text-center text-slate-500">Produk belum tersedia.</div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                @php $links = $products->toArray()['links']; @endphp
                <div class="flex justify-center mt-16 gap-2">
                    {{-- Previous --}}
                    @php $prev = $links[0]; @endphp
                    @if ($prev['url'])
                        <a href="{{ $prev['url'] }}" class="w-10 h-10 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:border-brand-500 hover:text-brand-500 transition-colors">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </a>
                    @else
                        <span class="w-10 h-10 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-300 cursor-not-allowed">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </span>
                    @endif

                    {{-- Pages --}}
                    @foreach (array_slice($links, 1, -1) as $link)
                        @if ($link['label'] === '...')
                            <span class="w-10 h-10 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-400">...</span>
                        @else
                            @php $isActive = $link['active']; @endphp
                            <a href="{{ $link['url'] ?? '#' }}" class="w-10 h-10 rounded-lg {{ $isActive ? 'bg-brand-600 text-white font-bold' : 'bg-white border border-slate-200 text-slate-600 hover:border-brand-500 hover:text-brand-500 font-medium' }} flex items-center justify-center transition-colors">
                                {{ $link['label'] }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @php $next = $links[count($links)-1]; @endphp
                    @if ($next['url'])
                        <a href="{{ $next['url'] }}" class="w-10 h-10 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:border-brand-500 hover:text-brand-500 transition-colors">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    @else
                        <span class="w-10 h-10 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-300 cursor-not-allowed">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </div>


@endsection


@section('custom_script')

  <script>
        lucide.createIcons();
        

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

        // Auto submit selects for sort & per_page
        document.querySelectorAll('[data-auto-submit]').forEach(el => {
            el.addEventListener('change', () => el.form.submit());
        });

    </script>
@endsection
