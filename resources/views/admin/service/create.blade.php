@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')

<!-- Memanggil file CSS slider dan Icon FontAwesome agar gaya visual form seragam -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
<!-- jQuery (diperlukan untuk Summernote) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        const maxChars = 250;

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
            ],
            // Callback untuk membatasi jumlah karakter di Summernote
            callbacks: {
                onKeydown: function(e) {
                    var t = editor.code();
                    // Hilangkan tag HTML untuk menghitung teks murni
                    var plainText = $('<div>').html(t).text();
                    
                    // Tombol yang diizinkan untuk ditekan meskipun sudah limit (seperti Backspace, Delete, Panah)
                    var allowedKeys = [8, 46, 37, 38, 39, 40];
                    
                    if (plainText.length >= maxChars && !allowedKeys.includes(e.keyCode)) {
                        // Batasi jika bukan tombol kontrol
                        if (e.keyCode !== 8 && e.keyCode !== 46) {
                            e.preventDefault();
                        }
                    }
                },
                onPaste: function(e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    var currentText = $('<div>').html($('#editor').summernote('code')).text();
                    
                    if (currentText.length + bufferText.length > maxChars) {
                        e.preventDefault();
                        alert('Teks melebihi batas maksimal ' + maxChars + ' karakter!');
                    }
                },
                onChange: function(contents) {
                    var plainText = $('<div>').html(contents).text();
                    if (plainText.length > maxChars) {
                        // Potong string jika melebihi batas
                        var trimmed = plainText.substring(0, maxChars);
                        $('#editor').summernote('code', trimmed);
                        plainText = trimmed;
                    }
                    // Update counter secara real-time
                    $('#deskCount').text(plainText.length + ' / 250 karakter');
                }
            }
        });
    });
</script>

<div class="main-wrapper">
    <!-- Menggunakan batas max-width agar tampilan form tetap proporsional -->
    <div class="container" style="max-width: 600px;">
        
        <div class="card">
            
            <!-- Bagian Header Form -->
            <div class="header-section" style="border-bottom: 1px solid #e2e8f0; padding-bottom: 10px; margin-bottom: 20px;">
                <h1>Tambah Layanan</h1>
            </div>

            <!-- Blok Pesan Error Validasi Global -->
            @if ($errors->any())
                <div class="alert-danger" style="margin-bottom: 20px;">
                    <p style="margin: 0; font-weight: bold;">
                        <i class="fa-solid fa-triangle-exclamation"></i> Harap perbaiki kesalahan pengisian form di bawah ini.
                    </p>
                    <ul style="margin: 10px 0 0 0; padding-left: 20px; font-size: 13px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form tambah data layanan baru -->
            <form action="{{ route('service.store') }}" method="POST">
                @csrf

                <!-- Input Judul -->
                <div class="form-group">
                    <label for="judul">Judul <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="text" 
                        id="judul" 
                        name="judul" 
                        maxlength="35"
                        value="{{ old('judul') }}" 
                        placeholder="Masukkan judul layanan"
                        class="@error('judul') is-invalid @enderror"
                        required>
                    <small id="judulCount" class="text-muted" style="display: block; margin-top: 4px; text-align: right; color: #64748b; font-size: 12px;">0 / 35 karakter</small>
                    @error('judul')
                        <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

                <!-- Input Deskripsi -->
                <div class="form-group" style="margin-top: 15px;">
                    <label for="isi">Deskripsi <span style="color: #ef4444;">*</span></label>
                    <textarea id="editor" name="isi" class="@error('isi') is-invalid @enderror" required>{{ old('isi') }}</textarea> 
                         
                    <small id="deskCount" class="text-muted" style="display: block; margin-top: 4px; text-align: right; color: #64748b; font-size: 12px;">0 / 250 karakter</small>
                    @error('isi')
                        <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

                <!-- Input Urutan -->
                <div class="form-group" style="margin-top: 15px;">
                    <label for="urutan">Urutan Tampil <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="number" 
                        id="urutan" 
                        name="urutan" 
                        min="1"
                        value="{{ old('urutan', 1) }}" 
                        class="@error('urutan') is-invalid @enderror"
                        required>
                    @error('urutan')
                        <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

                <!-- Kelompok Tombol Aksi -->
                <div class="aksi" style="justify-content: flex-start; margin-top: 25px; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                    <button type="submit" class="btn btn-add" style="background: #10b981;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                    <a href="{{ route('service.index') }}" class="btn btn-edit" style="background: #64748b; color: white;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@include('layouts.footer_table')

<!-- Script Counter Karakter Real-time untuk Judul -->
<script>
    const judul = document.getElementById('judul');
    const judulCount = document.getElementById('judulCount');

    function updateJudulCounter() {
        judulCount.textContent = judul.value.length + " / 35 karakter";
    }

    judul.addEventListener('input', updateJudulCounter);
    document.addEventListener('DOMContentLoaded', updateJudulCounter);
</>

@endsection