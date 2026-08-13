@extends('layouts.admin')

@section('title', 'Edit Empat Kontak')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

{{-- Summernote CSS --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

<div class="main-wrapper">
    <div class="container" style="max-width: 600px;">

        <div class="card">

            <div class="header-section" style="border-bottom:1px solid #e2e8f0; padding-bottom:10px;">
                <h1>Edit Kontak</h1>
            </div>

            
            @if ($errors->any())
                <div class="alert-danger">
                    <ul style="margin:0; padding-left:20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('empat-kontak.update', $empatKontak->id) }}" method="POST">

                @csrf
                @method('PUT')

                
                <div class="form-group">
                    <label for="judul">Judul</label>

                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        value="{{ old('judul', $empatKontak->judul) }}"
                        placeholder="Contoh: Email"
                        required>
                </div>

               
                <div class="form-group">
                    <label for="editor">Isi</label>

                    <textarea
                        id="editor"
                        name="isi"
                        rows="5"
                        required>{{ old('isi', $empatKontak->isi) }}</textarea>
                </div>

                
                <div class="form-group">
                    <label for="text_link">Teks Link</label>

                    <input
                        type="text"
                        id="text_link"
                        name="text_link"
                        value="{{ old('text_link', $empatKontak->text_link) }}"
                        placeholder="Contoh: Kirim Email"
                        required>
                </div>

                
                <div class="form-group">
                    <label for="link">Link</label>

                    <input
                        type="text"
                        id="link"
                        name="link"
                        value="{{ old('link', $empatKontak->link) }}"
                        placeholder="https://... / mailto:... / tel:..."
                        required>
                </div>

               
                <div class="form-group">
                    <label for="urutan">Urutan</label>

                    <input
                        type="number"
                        id="urutan"
                        name="urutan"
                        value="{{ old('urutan', $empatKontak->urutan) }}"
                        min="1"
                        required>
                </div>

             
                 <div class="aksi" style="justify-content: flex-start; margin-top: 25px; gap: 10px;">
                    <button type="submit" class="btn btn-add" style="background: #10b981;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Data
                    </button>
                    <a href="{{ route('empat-kontak.index') }}" class="btn btn-edit" style="background: #64748b; color: white;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>

    </div>
</div>

@include('layouts.footer_table')

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Summernote JS --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function () {

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

@endsection