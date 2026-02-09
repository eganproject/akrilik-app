<header class="sticky top-0 z-20 border-b border-slate-800 bg-slate-900/70 backdrop-blur px-4 py-3 flex items-center gap-4">
    <div class="flex-1 hidden md:flex items-center gap-3 rounded-xl border border-slate-800 bg-slate-800/60 px-3 py-2 text-sm text-slate-300">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"></circle>
            <line x1="16.65" y1="16.65" x2="21" y2="21"></line>
        </svg>
        <input type="text" placeholder="Cari modul atau data..." class="w-full bg-transparent outline-none placeholder:text-slate-500 text-slate-100">
    </div>
    <button class="hidden md:inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-sky-500 to-blue-500 px-4 py-2 text-sm font-semibold text-slate-900 shadow-lg shadow-sky-500/25">Buat Laporan</button>
    <div class="flex items-center gap-3 rounded-xl border border-slate-800 bg-slate-800/60 px-3 py-2">
        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-sky-500 to-purple-500 flex items-center justify-center font-bold text-slate-900">
            {{ strtoupper(substr(auth()->user()->name ?? 'A',0,2)) }}
        </div>
        <div class="text-sm leading-tight">
            <div class="font-semibold">{{ auth()->user()->name ?? 'Admin' }}</div>
            <div class="text-slate-400">{{ auth()->user()->email ?? 'admin@example.com' }}</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="ml-2 rounded-lg bg-gradient-to-r from-rose-500 to-orange-400 px-3 py-2 text-xs font-semibold text-white">Keluar</button>
        </form>
    </div>
</header>
