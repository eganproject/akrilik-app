<aside class="hidden md:flex flex-col gap-6 border-r border-slate-800 bg-slate-900/60 backdrop-blur px-6 py-6">
    <div class="flex items-center gap-3 rounded-2xl bg-gradient-to-r from-sky-500/20 to-purple-500/20 border border-slate-800 px-4 py-3">
        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-sky-500 to-purple-500 flex items-center justify-center font-black text-slate-900">M</div>
        <div>
            <p class="text-sm text-slate-300">Admin Panel</p>
            <p class="font-semibold">Media Gudang Acc</p>
        </div>
    </div>

    <nav class="space-y-4 text-sm font-semibold">
        <div>
            <p class="text-xs uppercase tracking-wide text-slate-500 mb-2">Overview</p>
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white border border-sky-500/40' : 'hover:bg-slate-800 text-slate-200' }}">
                Dashboard
            </a>
        </div>
        <div>
            <p class="text-xs uppercase tracking-wide text-slate-500 mb-2">Content</p>
            <a href="{{ route('admin.product-categories.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-xl {{ request()->routeIs('admin.product-categories.*') ? 'bg-slate-800 text-white border border-sky-500/40' : 'hover:bg-slate-800 text-slate-200' }}">
                Kategori Produk
            </a>
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-xl {{ request()->routeIs('admin.products.*') ? 'bg-slate-800 text-white border border-sky-500/40' : 'hover:bg-slate-800 text-slate-200' }}">
                Produk
            </a>
            <a href="{{ route('admin.featured-categories.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-xl {{ request()->routeIs('admin.featured-categories.*') ? 'bg-slate-800 text-white border border-sky-500/40' : 'hover:bg-slate-800 text-slate-200' }}">
                Kategori Unggulan
            </a>
            {{-- <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-slate-800 text-slate-200">Pages</a>
            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-slate-800 text-slate-200">Media</a> --}}
        </div>
        {{-- <div>
            <p class="text-xs uppercase tracking-wide text-slate-500 mb-2">System</p>
            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-slate-800 text-slate-200">Settings</a>
            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-slate-800 text-slate-200">Integrations</a>
        </div> --}}
    </nav>

    <div class="mt-auto rounded-2xl border border-slate-800 bg-slate-800/70 px-4 py-3 text-sm text-slate-300">
        Sistem stabil • 99.9% uptime
    </div>
</aside>
