@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')

<!-- Menggunakan stylesheet slider.css dan ikon FontAwesome -->
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
            callbacks: {
                onKeydown: function(e) {
                    var t = $('#editor').summernote('code');
                    var plainText = $('<div>').html(t).text();
                    var allowedKeys = [8, 46, 37, 38, 39, 40];

                    if (plainText.length >= maxChars && !allowedKeys.includes(e.keyCode)) {
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
                        var trimmed = plainText.substring(0, maxChars);
                        $('#editor').summernote('code', trimmed);
                        plainText = trimmed;
                    }
                    $('#deskCount').text(plainText.length + ' / 250 karakter');
                }
            }
        });
    });
</script>
<div class="main-wrapper">
    <!-- Menggunakan batas max-width kecil agar layout form tetap proporsional -->
    <div class="container" style="max-width: 600px;">
        
        <div class="card">
            
            <!-- Bagian Header Form -->
            <div class="header-section" style="border-bottom: 1px solid #e2e8f0; padding-bottom: 10px; margin-bottom: 20px;">
                <h1>Edit Layanan</h1>
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

            <!-- Form edit data -->
            <form action="{{ route('service.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input Judul -->
                <div class="form-group">
                    <label for="judul">Judul <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="text" 
                        id="judul" 
                        name="judul" 
                        maxlength="35"
                        value="{{ old('judul', $service->judul) }}" 
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

                <div class="form-group" style="margin-top: 15px;">
                    <label for="isi">Deskripsi <span style="color: #ef4444;">*</span></label>
                    <textarea id="editor" name="isi" class="@error('isi') is-invalid @enderror" required>{{ old('isi', $service->isi ?? '') }}</textarea>
                    <small id="deskCount" class="text-muted" style="display: block; margin-top: 4px; text-align: right; color: #64748b; font-size: 12px;">0 / 250 karakter</small>
                    @error('isi')
                        <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <label for="urutan">Urutan Tampil <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="number" 
                        id="urutan" 
                        name="urutan" 
                        min="1"
                        value="{{ old('urutan', $service->urutan) }}" 
                        class="@error('urutan') is-invalid @enderror"
                        required>
                    @error('urutan')
                        <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

                <!-- Kelompok Tombol Aksi menggunakan wrapper .aksi bawaan slider.css -->
                <div class="aksi" style="justify-content: flex-start; margin-top: 25px; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                    <button type="submit" class="btn btn-add" style="background: #10b981;">
                        <i class="fa-solid fa-floppy-disk"></i> Update
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

<script>
    const judul = document.getElementById('judul');
    const judulCount = document.getElementById('judulCount');

    function updateJudulCounter() {
        judulCount.textContent = judul.value.length + ' / 35 karakter';
    }

    judul.addEventListener('input', updateJudulCounter);
    document.addEventListener('DOMContentLoaded', updateJudulCounter);
</script>

@endsection