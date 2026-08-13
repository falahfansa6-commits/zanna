@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">


<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- jQuery (diperlukan untuk Summernote) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <Script>
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
                <h1>Edit Our Value</h1>
            </div>

            
            @if($errors->any())
                <div class="alert-danger">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

          
            <form action="{{ route('ourvalues.update', $ourvalue->id) }}" method="POST">
                @csrf
                @method('PUT')

               
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input 
                        type="text" 
                        id="judul"
                        name="judul" 
                        value="{{ old('judul', $ourvalue->judul) }}" 
                        placeholder="Masukkan judul..." 
                        required>
                </div>

                <!-- Input Deskripsi -->
                <div class="form-group">
                    <label for="isi">Deskripsi</label>
                    <textarea id="editor" name="isi">
        {{ old('isi', $ourvalue->isi ?? '') }}
    </textarea>
                </div>

            
                <div class="form-group">
                    <label for="urutan">Urutan Halaman</label>
                    <input 
                        type="number" 
                        id="urutan"
                        name="urutan" 
                        value="{{ old('urutan', $ourvalue->urutan) }}" 
                        placeholder="Contoh: 1" 
                        required>
                </div>

              
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="1" {{ old('status', $ourvalue->status) == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status', $ourvalue->status) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

               
                 <div class="aksi" style="justify-content: flex-start; margin-top: 25px; gap: 10px;">
                    <button type="submit" class="btn btn-add" style="background: #10b981;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Data
                    </button>
                    <a href="{{ route('ourvalues.index') }}" class="btn btn-edit" style="background: #64748b; color: white;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@include('layouts.footer_table')

@endsection