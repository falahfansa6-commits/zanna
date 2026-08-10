<!DOCTYPE html>
<html lang="en">
<head>
    @extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Tentang Kami</title>
    <!-- Tambahkan CDN FontAwesome untuk ikon tombol -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- jQuery (diperlukan untuk Summernote) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
    $('#editor').summernote({
        placeholder: 'Masukkan konten...',
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});
</script>
</head>
<body>

<div class="main-wrapper">
    <div class="container" style="max-width: 800px;"> <!-- Membatasi lebar form agar proporsional -->
        <div class="card">

            <!-- Header Section -->
            <div class="header-section" style="margin-bottom: 30px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
                <h1 style="font-size: 24px;">
                    <i class="fa-solid fa-address-card" style="color: #566270; margin-right: 8px;"></i>Edit Tentang Kami
                </h1>
            </div>

            <!-- Pesan Error Validasi -->
            @if ($errors->any())
                <div class="alert-danger" style="background:#fef2f2; color:#991b1b; border: 1px solid #fca5a5; padding:14px 18px; border-radius:12px; margin-bottom:20px; font-size: 14px;">
                    <ul style="margin-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tentang.update', $tentang->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul">Judul Utama</label>
                    <input 
                        type="text"
                        id="judul"
                        name="judul"
                        value="{{ old('judul', $tentang->judul) }}"
                        placeholder="Masukkan judul konten"
                        required>
                </div>

                <div class="form-group">
                    <label for="isi">Isi Konten / Deskripsi</label>
                   <textarea id="editor" name="isi">
        {{ old('isi', $tentang->isi ?? '') }}
    </textarea>
                </div>

                @if($tentang->gambar)
                    <div class="form-group">
                        <label>Gambar Saat Ini</label>
                        <div class="image-preview" style="display: flex; justify-content: flex-start; margin-top: 5px;">
                            <div class="image-wrapper" style="width: 200px; height: 112px; margin: 0;">
                                <img src="{{ asset($tentang->gambar) }}"
                                     alt="Tentang Kami"
                                     class="preview">
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label for="gambar">Ganti File Gambar</label>
                    <input 
                        type="file" 
                        id="gambar"
                        name="gambar"
                        accept="image/*"
                        style="padding: 8px 12px;">
                    <small class="text-muted" style="color: #64748b; font-size: 13px; display: block; margin-top: 6px;">
                        <i class="fa-solid fa-circle-info"></i> Kosongkan jika tidak ingin mengganti gambar, Format yang di dukung: jpg,jpeg,png,webp MAX 2MB.
                    </small>
                </div>

                
                <div class="aksi" style="justify-content: flex-start; margin-top: 25px; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                   
                    <button type="submit" class="btn btn-add" style="background-color: #10b981;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>

                    
                    <a href="{{ route('tentang.index') }}" class="btn btn-edit" style="background-color: #64748b; color: white;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

    
    
</div>
@include('layouts.footer_table')
</body>
</html>
@endsection