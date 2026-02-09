@extends('layouts.landing')

@section('title', 'MGA App')

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
                        'pop-in': 'popIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
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
@include('partials.headerSection', ['title_1' => 'Frame it to', 'title_2' => ' Claim it.', 'description' => 'Jadikan setiap partikel dari usahamu tersampaikan pada calon pelanggan setia kamu.'])

    <!-- CATEGORY LIST GRID -->
    <section class="py-16 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- SEARCH BAR -->
            <div class="max-w-xl mx-auto mb-16 relative animate-fade-in-up" style="animation-delay: 200ms;">
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-brand-300 to-purple-300 rounded-full blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                    <input type="text" id="categorySearch" placeholder="Cari kategori produk (contoh: Stand Display, Tripod)..." class="relative w-full pl-14 pr-6 py-4 rounded-full border border-white bg-white/90 backdrop-blur-sm text-slate-800 focus:ring-2 focus:ring-brand-200 focus:border-brand-500 outline-none shadow-lg transition-all placeholder:text-slate-400">
                    <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 text-brand-500 w-5 h-5 z-10"></i>
                </div>
            </div>

            <!-- CATEGORY GRID -->
            <div id="categoryGrid" class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($categories as $idx => $cat)
                    <a href="{{ route('kategori.show', $cat->slug) }}" class="category-card group relative bg-white rounded-[2.5rem] p-8 border border-slate-200 hover:border-brand-200 shadow-lg hover:shadow-2xl hover:shadow-brand-500/10 transition-all duration-500 overflow-hidden flex flex-col h-full animate-pop-in" style="animation-delay: {{ $idx*100 }}ms;">
                        <div class="h-48 w-full flex items-center justify-center mb-6 relative">
                             <div class="absolute inset-0 bg-brand-500/5 blur-2xl rounded-full scale-50 group-hover:scale-100 transition-transform duration-500"></div>
                             @if($cat->image)
                                <img src="{{ Storage::disk('public')->url($cat->image) }}" alt="{{ $cat->name }}" class="h-full w-auto object-contain drop-shadow-md animate-float relative z-10">
                             @else
                                <div class="h-32 w-32 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-xl animate-float relative z-10">{{ strtoupper(substr($cat->name,0,2)) }}</div>
                             @endif
                        </div>
                        <div class="text-center mb-4 flex-grow flex items-center justify-center">
                            <h3 class="font-display text-2xl font-bold text-slate-900 group-hover:text-brand-600 transition-colors">{{ $cat->name }}</h3>
                        </div>
                        <div class="mt-auto pt-6 border-t border-slate-100 flex items-center justify-between w-full">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                            <div class="w-10 h-10 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center group-hover:bg-brand-50 group-hover:text-brand-600 transition-colors">
                                <i data-lucide="arrow-right" class="w-5 h-5 transition-transform group-hover:translate-x-1"></i>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center text-slate-500">Belum ada kategori.</div>
                @endforelse
            </div>

            <div class="mt-10 flex justify-center">
                {{ $categories->links() }}
            </div>
        </div>
    </section>
@endsection


@section('custom_script')
 <script>
        lucide.createIcons();
        
        // Data Produk Dummy (untuk Mega Menu)
        const productsData = {
            'interactive': [ { name: 'MaxHub V6 Classic', img: 'monitor' }, { name: 'MaxHub V6 ViewPro', img: 'monitor' }, { name: 'Iceboard E2 Series', img: 'monitor' }, { name: 'Horion M5A', img: 'monitor' }, { name: 'Samsung Flip Pro', img: 'monitor' }, { name: 'LG One:Quick', img: 'monitor' } ],
            'mobile': [ { name: 'Portable LCD 43"', img: 'smartphone' }, { name: 'Portable LCD 55"', img: 'smartphone' }, { name: 'Foldable Signage', img: 'smartphone' }, { name: 'Battery Powered LCD', img: 'smartphone' }, { name: 'Outdoor Mobile Kiosk', img: 'smartphone' }, { name: 'Slimline Portable', img: 'smartphone' } ],
            'signage': [ { name: 'Wall Mount LCD', img: 'layout' }, { name: 'High Brightness LCD', img: 'layout' }, { name: 'Stretched Bar LCD', img: 'layout' }, { name: 'Double Sided Screen', img: 'layout' }, { name: 'Menu Board Display', img: 'layout' }, { name: 'Video Wall LCD', img: 'layout' } ],
            'videotron': [ { name: 'Indoor P1.8 LED', img: 'grid-3x3' }, { name: 'Indoor P2.5 LED', img: 'grid-3x3' }, { name: 'Outdoor P3.9 LED', img: 'grid-3x3' }, { name: 'Outdoor P5 LED', img: 'grid-3x3' }, { name: 'Transparent LED', img: 'grid-3x3' }, { name: 'Flexible LED Module', img: 'grid-3x3' } ],
            'kiosk': [ { name: 'Self Order Kiosk', img: 'mouse-pointer-click' }, { name: 'Payment Kiosk', img: 'mouse-pointer-click' }, { name: 'Information Kiosk', img: 'mouse-pointer-click' }, { name: 'Ticket Dispenser', img: 'mouse-pointer-click' }, { name: 'Check-in Kiosk', img: 'mouse-pointer-click' }, { name: 'Directory Kiosk', img: 'mouse-pointer-click' } ],
            'access': [ { name: 'Standing Bracket', img: 'layers' }, { name: 'Wall Mount Bracket', img: 'layers' }, { name: 'Ceiling Mount', img: 'layers' }, { name: 'Video Wall Push-out', img: 'layers' }, { name: 'Mobile Cart Stand', img: 'layers' }, { name: 'HDMI/VGA Cables', img: 'layers' } ]
        };

        const categoryTitles = { 'interactive': 'Interactive Panel', 'mobile': 'Mobile Signage', 'signage': 'Digital Signage', 'videotron': 'Videotron LED', 'kiosk': 'Kiosk System', 'access': 'Aksesoris' };

        function showCategory(catId) {
            // override ke handler navbar dinamis
            const key = document.querySelector('.category-item')?.dataset.navCategory || catId;
            if (window.__navShowCategory) {
                window.__navShowCategory(key);
            }
        }

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

        window.addEventListener('DOMContentLoaded', () => { showCategory('interactive'); });
        
        // Search Filter Logic
        document.getElementById('categorySearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.category-card');

            cards.forEach(card => {
                const title = card.querySelector('h3').innerText.toLowerCase();
                // Check if title includes search term
                if (title.includes(searchTerm)) {
                    card.style.display = 'flex'; // Use flex to maintain card layout
                } else {
                    card.style.display = 'none';
                }
            });
        });

    </script>
@endsection
