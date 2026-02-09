@php use Illuminate\Support\Str; @endphp

@php
    $slugPreview = old('name')
        ? Str::slug(old('name'))
        : ($product->slug ?? Str::slug($product->name ?? ''));
@endphp

<div class="grid gap-4 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-4">
        <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-xl shadow-slate-900/50 space-y-4">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-200">Kategori</label>
                <select name="product_category_id" class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-3 py-2 text-slate-100 focus:border-sky-500 focus:outline-none" required>
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('product_category_id', $product->product_category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-slate-400">Wajib pilih kategori produk.</p>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-200" for="name">Nama Produk</label>
                <input id="name" name="name" type="text" value="{{ old('name', $product->name ?? '') }}" required placeholder="Contoh: Laptop Kerja" class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-3 py-2 text-slate-100 placeholder:text-slate-500 focus:border-sky-500 focus:outline-none">
                <p class="text-xs text-slate-400">Harus diisi, maksimal 255 karakter.</p>
            </div>

            <div class="space-y-1">
                <p class="flex items-center justify-between text-xs text-slate-400">
                    <span>Slug (otomatis)</span>
                    <span class="text-[11px]">terisi otomatis dari nama</span>
                </p>
                <div id="slug-preview" class="w-full rounded-xl border border-slate-700 bg-slate-800/60 px-3 py-2 text-slate-200 text-sm font-medium">{{ $slugPreview }}</div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-200" for="excerpt">Excerpt</label>
                <textarea id="excerpt" name="excerpt" rows="2" class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-3 py-2 text-slate-100 placeholder:text-slate-500 focus:border-sky-500 focus:outline-none">{{ old('excerpt', $product->excerpt ?? '') }}</textarea>
                <p class="text-xs text-slate-400">Ringkasan singkat (opsional, maks 500 karakter).</p>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-200" for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="5" class="w-full rounded-xl border border-slate-700 bg-slate-800/70 px-3 py-2 text-slate-100 placeholder:text-slate-500 focus:border-sky-500 focus:outline-none">{{ old('description', $product->description ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-xl shadow-slate-900/50 space-y-4">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-200" for="thumbnail">Thumbnail</label>
                <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="block w-full text-sm text-slate-200 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-800 file:px-3 file:py-2 file:text-slate-100 hover:file:bg-slate-700">
                <p class="text-xs text-slate-400">Gambar opsional, maks 2MB.</p>
                <div id="thumbnail-preview" class="flex items-center gap-3 {{ empty($product->thumbnail) ? 'hidden' : '' }}">
                    <span class="text-xs text-slate-400">Pratinjau:</span>
                    <img id="thumbnail-preview-img" src="{{ !empty($product->thumbnail) ? Storage::disk('public')->url($product->thumbnail) : '' }}" alt="Preview" class="h-16 w-20 rounded-lg object-cover">
                </div>
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label class="block text-sm font-semibold text-slate-200" for="images">Galeri (dinamis)</label>
                    <button type="button" id="add-gallery-row" class="rounded-lg border border-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-100 hover:border-sky-500/60">Tambah Gambar</button>
                </div>
                <p class="text-xs text-slate-400">Bisa tambah beberapa gambar, masing-masing maks 2MB. Urutan diatur pada kolom angka.</p>
                <div id="gallery-rows" class="space-y-2">
                    <!-- rows injected by JS -->
                </div>
                @if(!empty($product->images) && $product->images->count())
                    <p class="text-xs text-slate-400 mt-2">Galeri tersimpan (bisa ubah file & urutan):</p>
                    <div class="mt-2 space-y-2">
                        @foreach($product->images as $img)
                            <div class="grid grid-cols-[120px_1fr_auto] gap-3 items-center rounded-lg border border-slate-800 bg-slate-800/50 p-3">
                                <div class="relative h-20 w-full rounded-md overflow-hidden border border-slate-700 existing-preview" data-id="{{ $img->id }}" style="background-image:url('{{ Storage::disk('public')->url($img->file_path) }}'); background-size:cover; background-position:center;">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs text-slate-400">Ganti gambar (opsional, maks 2MB)</label>
                                    <input type="file" name="existing_files[{{ $img->id }}]" accept="image/*" class="w-full text-sm text-slate-200 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-800 file:px-3 file:py-2 file:text-slate-100 hover:file:bg-slate-700">
                                    <label class="block text-xs text-slate-400">Urutan</label>
                                    <input type="number" name="existing_sort_orders[{{ $img->id }}]" value="{{ $img->sort_order }}" min="0" class="w-24 rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm text-slate-100">
                                </div>
                                <button type="button"
                                        class="delete-image rounded-lg bg-rose-500/80 px-3 py-2 text-xs font-semibold text-white"
                                        data-url="{{ route('admin.product-images.destroy', $img) }}"
                                        data-confirm="Hapus gambar ini?">
                                    Hapus
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <label class="inline-flex items-center gap-2 text-sm text-slate-200">
                <input type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-slate-600 bg-slate-800 text-sky-500 focus:ring-sky-500" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                <span>Aktifkan produk</span>
            </label>

            <div class="flex flex-wrap gap-2 pt-2">
                <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-sky-500 to-blue-500 px-4 py-2 text-sm font-semibold text-slate-900 shadow-lg shadow-sky-500/30">Simpan</button>
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center rounded-xl border border-slate-700 px-4 py-2 text-sm font-semibold text-slate-200 hover:border-sky-500/60">Batal</a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    {{-- CKEditor 4 (gratis) dari CDN untuk field deskripsi --}}
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const desc = document.getElementById('description');
            if (!desc) return;
            CKEDITOR.replace('description', {
                height: 280,
                removeButtons: 'Flash,Smiley,SpecialChar' // simple toolbar, bisa diubah sesuai kebutuhan
            });
        });
    </script>
@endpush
