@extends('layouts.admin')

@section('content')
    <div class="flex flex-col gap-2">
        <p class="text-sm text-slate-400">Selamat datang kembali, {{ auth()->user()->name ?? 'Admin' }}</p>
        <h1 class="text-2xl font-semibold">Dashboard</h1>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-xl shadow-slate-900/50">
            <p class="text-sm text-slate-400">Total Produk</p>
            <div class="mt-2 flex items-end justify-between">
                <span class="text-3xl font-bold">{{ $stats['products'] }}</span>
                <span class="text-xs text-slate-500">semua produk</span>
            </div>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-xl shadow-slate-900/50">
            <p class="text-sm text-slate-400">Produk Aktif</p>
            <div class="mt-2 flex items-end justify-between">
                <span class="text-3xl font-bold text-emerald-300">{{ $stats['products_active'] }}</span>
                <span class="text-xs text-slate-500">dapat dilihat pengguna</span>
            </div>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-xl shadow-slate-900/50">
            <p class="text-sm text-slate-400">Kategori</p>
            <div class="mt-2 flex items-end justify-between">
                <span class="text-3xl font-bold">{{ $stats['categories'] }}</span>
                <span class="text-xs text-slate-500">grup produk</span>
            </div>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-xl shadow-slate-900/50">
            <p class="text-sm text-slate-400">Kategori Unggulan</p>
            <div class="mt-2 flex items-end justify-between">
                <span class="text-3xl font-bold">{{ $stats['featured'] ?? 0 }}</span>
                <span class="text-xs text-slate-500">slot beranda</span>
            </div>
        </div>
    </div>

    <div class="grid gap-4 lg:grid-cols-2">
        <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-xl shadow-slate-900/50">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Produk Terbaru</h3>
                    <p class="text-xs text-slate-500">5 entri terakhir</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-slate-400">
                        <tr class="border-b border-slate-800">
                            <th class="py-2 pr-4 text-left">Produk</th>
                            <th class="py-2 pr-4 text-left">Kategori</th>
                            <th class="py-2 pr-4 text-left">Status</th>
                            <th class="py-2 text-left">Dibuat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($latestProducts as $prod)
                            <tr>
                                <td class="py-2 pr-4 text-slate-200">
                                    <div class="font-semibold">{{ $prod->name }}</div>
                                    <div class="text-xs text-slate-500">/{{ $prod->slug }}</div>
                                </td>
                                <td class="py-2 pr-4 text-slate-300">{{ $prod->category?->name ?? '-' }}</td>
                                <td class="py-2 pr-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $prod->is_active ? 'bg-emerald-500/20 text-emerald-200' : 'bg-amber-500/20 text-amber-200' }}">
                                        {{ $prod->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="py-2 text-slate-400 text-xs">{{ $prod->created_at?->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-4 text-center text-slate-500">Belum ada produk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-xl shadow-slate-900/50">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Kategori Terbaru</h3>
                    <p class="text-xs text-slate-500">5 entri terakhir</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-slate-400">
                        <tr class="border-b border-slate-800">
                            <th class="py-2 pr-4 text-left">Kategori</th>
                            <th class="py-2 pr-4 text-left">Status</th>
                            <th class="py-2 text-left">Dibuat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($latestCategories as $cat)
                            <tr>
                                <td class="py-2 pr-4 text-slate-200">
                                    <div class="font-semibold">{{ $cat->name }}</div>
                                    <div class="text-xs text-slate-500">/{{ $cat->slug }}</div>
                                </td>
                                <td class="py-2 pr-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $cat->is_active ? 'bg-emerald-500/20 text-emerald-200' : 'bg-amber-500/20 text-amber-200' }}">
                                        {{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="py-2 text-slate-400 text-xs">{{ $cat->created_at?->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-4 text-center text-slate-500">Belum ada kategori.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
