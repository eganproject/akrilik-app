@extends('layouts.admin')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-semibold">Tambah Kategori Produk</h2>
            <p class="text-sm text-slate-400">Masukkan detail kategori dan unggah gambar.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="rounded-xl border border-rose-500/60 bg-rose-500/10 px-4 py-3 text-sm text-rose-100">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.product-categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @include('admin.product_categories._form', ['category' => new \App\Models\ProductCategory()])
    </form>
@endsection

@push('scripts')
<script>
    (() => {
        const nameInput = document.getElementById('name');
        const slugPreview = document.getElementById('slug-preview');
        const imageInput = document.getElementById('image');
        const previewWrap = document.getElementById('image-preview');
        const previewImg = document.getElementById('image-preview-img');
        const slugify = (str) => str.toString().normalize('NFD').replace(/[\\u0300-\\u036f]/g,'').trim().toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/^-+|-+$/g,'');
        if (nameInput && slugPreview) {
            const setSlug = () => slugPreview.textContent = slugify(nameInput.value);
            setSlug();
            nameInput.addEventListener('input', setSlug);
        }
        if (imageInput && previewWrap && previewImg) {
            imageInput.addEventListener('change', (e) => {
                const [file] = e.target.files || [];
                if (!file) { previewWrap.classList.add('hidden'); previewImg.src=''; return; }
                previewImg.src = URL.createObjectURL(file);
                previewWrap.classList.remove('hidden');
            });
        }
    })();
</script>
@endpush
