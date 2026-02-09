@php
    $category = $category ?? new \App\Models\ProductCategory();
    $slugPreview = old('name')
        ? Str::slug(old('name'))
        : ($category->slug ?? Str::slug($category->name ?? ''));
@endphp

<div class="grid gap-4 lg:grid-cols-2">
    <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-xl shadow-slate-900/50 space-y-4">
        <div class="space-y-2">
            <label for="name" class="block text-sm font-semibold text-slate-200">Nama Kategori</label>
            <input id="name" name="name" type="text" value="{{ old('name', $category->name ?? '') }}" required placeholder="Contoh: Elektronik Rumah" class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-3 py-2 text-slate-100 placeholder:text-slate-500 focus:border-sky-500 focus:outline-none">
        </div>

        <div class="space-y-2">
            <label class="flex items-center justify-between text-xs text-slate-400">
                <span>Slug (otomatis)</span>
                <span class="text-[11px]">terisi otomatis dari nama</span>
            </label>
            <div id="slug-preview" class="w-full rounded-xl border border-slate-700 bg-slate-800/60 px-3 py-2 text-slate-200 text-sm font-medium">{{ $slugPreview }}</div>
        </div>

        <div class="space-y-2">
            <label for="description" class="block text-sm font-semibold text-slate-200">Deskripsi</label>
            <textarea id="description" name="description" rows="5" class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-3 py-2 text-slate-100 placeholder:text-slate-500 focus:border-sky-500 focus:outline-none">{{ old('description', $category->description ?? '') }}</textarea>
        </div>

        <div class="space-y-2">
            <label for="sort_order" class="block text-sm font-semibold text-slate-200">Urutan</label>
            <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="w-32 rounded-xl border border-slate-700 bg-slate-800/70 px-3 py-2 text-slate-100 focus:border-sky-500 focus:outline-none">
            <p class="text-xs text-slate-400">Angka kecil ditampilkan lebih dahulu.</p>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-xl shadow-slate-900/50 space-y-4">
        <div class="space-y-2">
            <label for="image" class="block text-sm font-semibold text-slate-200">Gambar Kategori</label>
            <input id="image" name="image" type="file" accept="image/*" class="block w-full text-sm text-slate-200 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-800 file:px-3 file:py-2 file:text-slate-100 hover:file:bg-slate-700">
        </div>
        <div id="image-preview" class="flex items-center gap-3 {{ empty($category->image) ? 'hidden' : '' }}">
            <span class="text-xs text-slate-400">Pratinjau:</span>
            <img id="image-preview-img" src="{{ !empty($category->image) ? Storage::disk('public')->url($category->image) : '' }}" alt="Preview" class="h-16 w-20 rounded-lg object-cover">
        </div>

        <label class="inline-flex items-center gap-2 text-sm text-slate-200">
            <input type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-slate-600 bg-slate-800 text-sky-500 focus:ring-sky-500" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}>
            <span>Aktifkan kategori</span>
        </label>

        <div class="flex flex-wrap gap-2 pt-2">
            <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-sky-500 to-blue-500 px-4 py-2 text-sm font-semibold text-slate-900 shadow-lg shadow-sky-500/30">Simpan</button>
            <a href="{{ route('admin.product-categories.index') }}" class="inline-flex items-center rounded-xl border border-slate-700 px-4 py-2 text-sm font-semibold text-slate-200 hover:border-sky-500/60">Batal</a>
        </div>
    </div>
</div>
