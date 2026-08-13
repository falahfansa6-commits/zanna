@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')

<!-- Hubungkan ke FontAwesome & File CSS Utama -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<!-- Include jQuery & CSS/JS Summernote CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<div class="main-wrapper">
    <div class="container">
        <div class="card">
            
            <div class="header-section">
                <h1>Edit Product</h1>
            </div>

            @if($errors->any())
                <div class="alert-success" style="background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <ul class="mb-0" style="list-style-type: none; padding-left: 0; margin: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="mb-3" style="margin-bottom: 20px;">
                    <label for="judul" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: #1e293b;">
                        Judul
                    </label>
                    <input 
                        type="text" 
                        id="judul" 
                        name="judul" 
                        class="form-control" 
                        value="{{ old('judul', $product->judul) }}" 
                        required
                        style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;"
                    >
                </div>

                <!-- Isi / Deskripsi dengan Summernote -->
                <div class="mb-3" style="margin-bottom: 20px;">
                    <label for="isi" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: #1e293b;">
                        Isi / Deskripsi
                    </label>
                    <textarea 
                        id="summernote" 
                        name="isi" 
                        class="form-control" 
                        rows="6" 
                        required
                    >{{ old('isi', $product->isi) }}</textarea>
                </div>

                <!-- Urutan -->
                <div class="mb-3" style="margin-bottom: 20px;">
                    <label for="urutan" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: #1e293b;">
                        Urutan
                    </label>
                    <input 
                        type="number" 
                        id="urutan" 
                        name="urutan" 
                        class="form-control" 
                        value="{{ old('urutan', $product->urutan) }}" 
                        required
                        style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;"
                    >
                </div>

                <!-- Gambar -->
                <div class="mb-3" style="margin-bottom: 20px;">
                    <label for="gambar" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: #1e293b;">
                        Gambar
                    </label>

                    @if($product->gambar)
                        <div class="mb-3" style="margin-bottom: 12px;">
                            <img 
                                src="{{ Storage::url($product->gambar) }}" 
                                width="150" 
                                class="img-thumbnail" 
                                alt="{{ $product->judul }}"
                                style="border-radius: 6px; border: 1px solid #cbd5e1; padding: 4px;"
                            >
                        </div>
                    @endif

                    <input 
                        type="file" 
                        id="gambar" 
                        name="gambar" 
                        class="form-control" 
                        accept="image/jpeg,image/png,image/webp"
                        style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; background: #f8fafc;"
                    >
                    <small class="text-muted" style="display: block; margin-top: 6px; color: #64748b; font-size: 12px;">
                        Kosongkan jika tidak ingin mengganti gambar.
                    </small>
                </div>

                <!-- Tombol Aksi -->
                <div class="aksi" style="display: flex; justify-content: flex-start; margin-top: 25px; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                    <button type="submit" class="btn" style="background-color: #10b981; color: white;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                    <a href="{{ route('products.index') }}" class="btn" style="background-color: #64748b; color: white; text-decoration: none;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

 @include('layouts.footer_table')
</div>

<!-- Inisialisasi Summernote -->
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Tulis deskripsi produk di sini...',
            tabsize: 2,
            height: 250, // Tinggi editor
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['codeview', 'help']]
            ]
        });
    });
</script>

@endsection