@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')

<!-- Memanggil file CSS dan Icon FontAwesome agar gaya visual form seragam -->
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
                <h1>Edit The Product</h1>
            </div>

            
            @if($errors->any())
                <div class="alert-danger">
                    <p style="margin: 0; font-weight: bold;">
                        <i class="fa-solid fa-triangle-exclamation"></i> Harap perbaiki kesalahan pengisian form di bawah ini.
                    </p>
                </div>
            @endif

            
            <form action="{{ route('theproduk.update', $theproduk->id) }}" method="POST">
                @csrf
                @method('PUT')

              
                <div class="form-group">
                    <label for="judul">Judul <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="text" 
                        id="judul" 
                        name="judul" 
                        maxlength="20"
                        value="{{ old('judul', $theproduk->judul) }}" 
                        placeholder="Masukkan judul produk (maks. 20 karakter)"
                        class="@error('judul') is-invalid @enderror"
                        required>
                    @error('judul')
                        <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

               
                <div class="form-group">
                    <label for="isi">Isi <span style="color: #ef4444;">*</span></label>
                   <textarea id="editor" name="isi"
                   placeholder="Masukkan deskripsi lengkap produk"
                        class="@error('isi') is-invalid @enderror"
                        required>
        {{ old('isi', $theproduk->isi ?? '') }}
    </textarea>
                        
                    @error('isi')
                        <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

               
                <div class="form-group">
                    <label for="urutan">Urutan <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="number" 
                        id="urutan" 
                        name="urutan" 
                        value="{{ old('urutan', $theproduk->urutan) }}" 
                        placeholder="Masukkan angka nomor urutan tampil"
                        class="@error('urutan') is-invalid @enderror"
                        required>
                    @error('urutan')
                        <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

               
                <div class="aksi" style="justify-content: flex-start; margin-top: 25px; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                    
                    <button type="submit" class="btn btn-add" style="background-color: #10b981;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>

                    <a href="{{ route('theproduk.index') }}" class="btn btn-edit" style="background-color: #64748b; color: white;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@include('layouts.footer_table')
@endsection