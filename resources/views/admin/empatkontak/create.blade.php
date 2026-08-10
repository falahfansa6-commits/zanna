@extends('layouts.admin')

@section('title', 'Hubungi Kami')

@section('content')

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

<div class="main-wrapper">

    <div class="container" style="max-width: 600px;">

        <div class="card">

            <div class="header-section" style="border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                <h1>Tambah Kontak</h1>
            </div>

            @if ($errors->any())
                <div class="alert-danger">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('empat-kontak.store') }}" method="POST">
                @csrf

                
                <div class="form-group">
                    <label>Judul</label>
                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul') }}"
                        placeholder="Contoh: EMAIL"
                        required>
                </div>

                
                <div class="form-group">
                    <label>Isi</label>
                   <textarea id="editor" name="isi">
        {{ old('isi', $empatkontaks->isi ?? '') }}
    </textarea>
                </div>

              
                <div class="form-group">
                    <label>Teks Link</label>
                    <input
                        type="text"
                        name="text_link"
                        value="{{ old('text_link') }}"
                        placeholder="Contoh: Kirim Email"
                        required>
                </div>

               
                <div class="form-group">
                    <label>Link</label>
                    <input
                        type="text"
                        name="link"
                        value="{{ old('link') }}"
                        placeholder="https://... / mailto:... / tel:..."
                        required>
                </div>

              
                <div class="form-group">
                    <label>Urutan</label>
                    <input
                        type="number"
                        name="urutan"
                        value="{{ old('urutan', 1) }}"
                        min="1"
                        required>
                </div>

                <div class="aksi" style="justify-content:flex-start; margin-top:25px; gap:10px;">

                    <button type="submit" class="btn btn-add">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Data
                    </button>

                    <a href="{{ route('empat-kontak.index') }}" class="btn btn-edit" style="background:#64748b;color:#fff;">
                        <i class="fa-solid fa-arrow-left"></i>
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>
@include('layouts.footer_table')

@endsection