@extends('layouts.admin')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-semibold">Kategori Unggulan (Landing)</h2>
            <p class="text-sm text-slate-400">Pilih hingga 3 kategori yang ditampilkan di beranda.</p>
        </div>
    </div>

    @if(session('status'))
        <div class="rounded-xl border border-emerald-600/50 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
            {{ session('status') }}
        </div>
    @endif
    @if($errors->any())
        <div class="rounded-xl border border-rose-500/60 bg-rose-500/10 px-4 py-3 text-sm text-rose-100">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.featured-categories.store') }}" method="POST" class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-xl shadow-slate-900/50 space-y-3">
        @csrf
        <div class="grid gap-3 sm:grid-cols-[2fr_1fr]">
            <div class="space-y-1">
                <label class="text-xs text-slate-400">Kategori</label>
                <select name="product_category_id" class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-3 py-2 text-slate-100 focus:border-sky-500 focus:outline-none" required>
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1">
                <label class="text-xs text-slate-400">Urutan</label>
                <input type="number" name="sort_order" min="0" value="0" class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-3 py-2 text-slate-100 focus:border-sky-500 focus:outline-none">
            </div>
        </div>
        <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-sky-500 to-blue-500 px-4 py-2 text-sm font-semibold text-slate-900 shadow-lg shadow-sky-500/30">Tambah</button>
        <p class="text-xs text-slate-400">Catatan: kategori tidak boleh duplikat; gunakan urutan 0-2 untuk tiga slot.</p>
    </form>

    <div class="mt-4 overflow-hidden rounded-2xl border border-slate-800 bg-slate-900/70 shadow-xl shadow-slate-900/50">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-900 text-slate-400">
                    <tr class="border-b border-slate-800">
                        <th class="px-4 py-3 text-left">Urutan</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Dibuat</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-slate-200">
                    @forelse($items as $item)
                        <tr class="hover:bg-slate-800/50">
                            <td class="px-4 py-3">
                                <form action="{{ route('admin.featured-categories.update', $item) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="sort_order" value="{{ $item->sort_order }}" min="0" class="w-20 rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm text-slate-100">
                                    <button type="submit" class="rounded-lg border border-slate-700 px-3 py-1 text-xs font-semibold text-slate-100 hover:border-sky-500/60">Simpan</button>
                                </form>
                            </td>
                            <td class="px-4 py-3">
                                <div class="font-semibold">{{ $item->category?->name ?? '-' }}</div>
                                <div class="text-xs text-slate-500">/{{ $item->category?->slug }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $item->category?->is_active ? 'bg-emerald-500/20 text-emerald-200' : 'bg-amber-500/20 text-amber-200' }}">
                                    {{ $item->category?->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-xs text-slate-400">{{ $item->created_at?->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                <form action="{{ route('admin.featured-categories.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus dari unggulan?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg bg-rose-500/80 px-3 py-1.5 text-xs font-semibold text-white">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">Belum ada kategori unggulan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
