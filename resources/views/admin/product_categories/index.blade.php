@extends('layouts.admin')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-semibold">Kategori Produk</h2>
            <p class="text-sm text-slate-400">Kelola kategori beserta gambar tampilannya.</p>
        </div>
        <a href="{{ route('admin.product-categories.create') }}" class="inline-flex items-center rounded-xl bg-gradient-to-r from-sky-500 to-blue-500 px-4 py-2 text-sm font-semibold text-slate-900 shadow-lg shadow-sky-500/30">Tambah Kategori</a>
    </div>

    @if(session('status'))
        <div class="rounded-xl border border-emerald-600/50 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
            {{ session('status') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900/70 shadow-xl shadow-slate-900/50">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-900 text-slate-400">
                    <tr class="border-b border-slate-800">
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Urutan</th>
                        <th class="px-4 py-3 text-left">Nama &amp; Gambar</th>
                        <th class="px-4 py-3 text-left">Deskripsi</th>
                        <th class="px-4 py-3 text-left">Aktif</th>
                        <th class="px-4 py-3 text-left">Dibuat</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-slate-200">
                    @forelse($categories as $index => $category)
                        <tr class="hover:bg-slate-800/50">
                            <td class="px-4 py-3">{{ $categories->firstItem() + $index }}</td>
                            <td class="px-4 py-3">
                                <form action="{{ route('admin.product-categories.update-order', $category) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="sort_order" value="{{ $category->sort_order }}" min="0" class="w-20 rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm text-slate-100">
                                    <button class="rounded-lg border border-slate-700 px-2 py-1 text-xs font-semibold text-slate-100 hover:border-sky-500/60">Simpan</button>
                                </form>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if($category->image)
                                        <img src="{{ Storage::disk('public')->url($category->image) }}" alt="{{ $category->name }}" class="h-12 w-16 rounded-lg object-cover flex-shrink-0">
                                    @else
                                        <div class="h-12 w-16 rounded-lg bg-slate-800/80 border border-slate-700 flex items-center justify-center text-xs text-slate-500 flex-shrink-0">No Img</div>
                                    @endif
                                    <div>
                                        <div class="font-semibold">{{ $category->name }}</div>
                                        <div class="text-xs text-slate-400">/{{ $category->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-slate-300">
                                {{ Str::limit($category->description, 80) ?? '—' }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $category->is_active ? 'bg-emerald-500/20 text-emerald-200' : 'bg-amber-500/20 text-amber-200' }}">
                                    {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-slate-300">{{ $category->created_at?->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap items-center gap-2">
                                    <a href="{{ route('admin.product-categories.edit', $category) }}" class="rounded-lg border border-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-100 hover:border-sky-500/60">Edit</a>
                                    <form action="{{ route('admin.product-categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg bg-gradient-to-r from-rose-500 to-orange-400 px-3 py-1.5 text-xs font-semibold text-white">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-slate-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-800 px-4 py-3 flex justify-end">
            {{ $categories->appends(request()->only('search'))->links() }}
        </div>
    </div>
@endsection
