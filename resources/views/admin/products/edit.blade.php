@extends('layouts.admin')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-semibold">Edit Produk</h2>
            <p class="text-sm text-slate-400">Perbarui detail produk dan galeri.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="rounded-xl border border-rose-500/60 bg-rose-500/10 px-4 py-3 text-sm text-rose-100">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        @include('admin.products._form', ['product' => $product])
    </form>
@endsection

@push('scripts')
<script>
    (() => {
        const nameInput = document.getElementById('name');
        const slugPreview = document.getElementById('slug-preview');
        const thumbInput = document.getElementById('thumbnail');
        const thumbWrap = document.getElementById('thumbnail-preview');
        const thumbImg = document.getElementById('thumbnail-preview-img');
        const galleryRows = document.getElementById('gallery-rows');
        const addRowBtn = document.getElementById('add-gallery-row');
        const existingFileInputs = document.querySelectorAll('input[name^=\"existing_files[\"]');
        const deleteButtons = document.querySelectorAll('.delete-image');
        const csrf = '{{ csrf_token() }}';
        const slugify = (str) => str.toString().normalize('NFD').replace(/[\\u0300-\\u036f]/g,'').trim().toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/^-+|-+$/g,'');
        if (nameInput && slugPreview) {
            const setSlug = () => slugPreview.textContent = slugify(nameInput.value);
            setSlug();
            nameInput.addEventListener('input', setSlug);
        }
        if (thumbInput && thumbWrap && thumbImg) {
            thumbInput.addEventListener('change', (e) => {
                const [file] = e.target.files || [];
                if (!file) { thumbWrap.classList.add('hidden'); thumbImg.src=''; return; }
                thumbImg.src = URL.createObjectURL(file);
                thumbWrap.classList.remove('hidden');
            });
        }

        const makeRow = () => {
            const idx = galleryRows.children.length;
            const row = document.createElement('div');
            row.className = 'flex flex-wrap items-center gap-2 rounded-xl border border-slate-800 bg-slate-800/50 px-3 py-3';
            row.innerHTML = `
                <div class="flex items-center gap-2 grow">
                    <input type="file" name="images[]" accept="image/*" class="grow text-sm text-slate-200 file:mr-3 file:rounded-lg file:border-0 file:bg-slate-800 file:px-3 file:py-2 file:text-slate-100 hover:file:bg-slate-700">
                    <div class="w-16 h-12 rounded-lg bg-slate-900 border border-slate-700 overflow-hidden flex items-center justify-center text-[11px] text-slate-500 preview-box">Prv</div>
                </div>
                <input type="number" name="sort_orders[]" min="0" value="${idx}" class="w-20 rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm text-slate-100" title="Urutan">
                <button type="button" class="remove-row rounded-lg bg-rose-500/80 px-3 py-1.5 text-xs font-semibold text-white">Hapus</button>
            `;
            const fileInput = row.querySelector('input[type=\"file\"]');
            const previewBox = row.querySelector('.preview-box');
            fileInput.addEventListener('change', (e) => {
                const [file] = e.target.files || [];
                if (!file) { previewBox.textContent = 'Prv'; previewBox.style.backgroundImage = ''; previewBox.classList.remove('bg-cover'); return; }
                previewBox.textContent = '';
                previewBox.style.backgroundImage = `url(${URL.createObjectURL(file)})`;
                previewBox.style.backgroundSize = 'cover';
                previewBox.style.backgroundPosition = 'center';
            });
            row.querySelector('.remove-row').addEventListener('click', () => row.remove());
            galleryRows.appendChild(row);
        };

        if (addRowBtn && galleryRows) {
            addRowBtn.addEventListener('click', makeRow);
            // don't auto-add on edit, let user click
        }

        // preview replacement for existing images
        if (existingFileInputs.length) {
            existingFileInputs.forEach((input) => {
                const id = input.name.match(/existing_files\\[(\\d+)\\]/)?.[1];
                const preview = document.querySelector(`.existing-preview[data-id=\"${id}\"]`);
                if (!preview) return;
                input.addEventListener('change', (e) => {
                    const [file] = e.target.files || [];
                    if (!file) { preview.textContent = ''; preview.style.backgroundImage=''; return; }
                    preview.style.backgroundImage = `url(${URL.createObjectURL(file)})`;
                    preview.style.backgroundSize = 'cover';
                    preview.style.backgroundPosition = 'center';
                });
            });
        }

        // delete existing image via separate form to avoid nested form issues
        if (deleteButtons.length) {
            deleteButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    if (!confirm(btn.dataset.confirm || 'Hapus?')) return;
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = btn.dataset.url;
                    form.innerHTML = `<input type=\"hidden\" name=\"_token\" value=\"${csrf}\"><input type=\"hidden\" name=\"_method\" value=\"DELETE\">`;
                    document.body.appendChild(form);
                    form.submit();
                });
            });
        }
    })();
</script>
@endpush
