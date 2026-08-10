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
            
          
            <div class="header-section" style="border-bottom: 1px solid #e2e8f0; padding-bottom: 10px; margin-bottom: 20px;">
                <h2 style="margin: 0;">Tambah Data Secound</h2>
            </div>

           
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

            
            <form action="{{ route('secound.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

             
                <div class="form-group">
                    <label for="judul">Judul <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="text" 
                        id="judul" 
                        name="judul" 
                        value="{{ old('judul') }}" 
                        placeholder="Masukkan Judul"
                        class="@error('judul') is-invalid @enderror"
                        required>
                    @error('judul')
                        <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

              
                <div class="form-group" style="margin-top: 15px;">
                    <label for="isi">Deskripsi <span style="color: #ef4444;">*</span></label>
                  <textarea id="editor" name="isi" class="note-editor">
        {{ old('isi', $tentang->isi ?? '') }}
    </textarea>
                    @error('isi')
                        <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

               
                <div class="form-group" style="margin-top: 15px;">
                    <label for="gambar">Upload Gambar <span style="color: #ef4444;">*</span></label>
                    
                   
                    <div style="margin-bottom: 12px;">
                        <div style="width: 150px; height: 150px; border-radius: 8px; overflow: hidden; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; background-color: #f8fafc; padding: 4px;">
                            <img id="imgPreview" src="" alt="Preview Gambar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px; display: none;">
                            <i id="placeholderIcon" class="fa-regular fa-image" style="font-size: 32px; color: #cbd5e1;"></i>
                        </div>
                    </div>

                    <input 
                        type="file" 
                        id="gambar" 
                        name="gambar" 
                        accept=".jpg,.jpeg,.png,.webp" 
                        class="@error('gambar') is-invalid @enderror"
                        onchange="previewImage(this)"
                        required>
                    <small style="color: #64748b; display: block; margin-top: 4px; font-size: 12px;">
                        Format yang didukung: JPG, JPEG, PNG, atau WEBP. MAX 4MB.  
                    </small>
                    
                    @error('gambar')
                        <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </small>
                    @enderror
                </div>

               
                <div class="aksi" style="justify-content: flex-start; margin-top: 25px; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                   
                    <button type="submit" class="btn btn-add" style="background-color: #10b981;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>

                  
                    <a href="{{ route('secound.index') }}" class="btn btn-edit" style="background-color: #64748b; color: white;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
    @include('layouts.footer_table')
</div>


<script>
    function previewImage(input) {
        const preview = document.getElementById('imgPreview');
        const placeholder = document.getElementById('placeholderIcon');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if(placeholder) {
                    placeholder.style.display = 'none';
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "";
            preview.style.display = 'none';
            if(placeholder) {
                placeholder.style.display = 'block';
            }
        }
    }
</script>

@endsection