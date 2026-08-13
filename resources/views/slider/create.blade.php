<!DOCTYPE html>
<html lang="en">
<head>
    @extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Slider</title>
    <!-- CDN FontAwesome untuk ikon tombol -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
</head>
<body>

<div class="main-wrapper">
    <div class="container" style="max-width: 800px;"> 
        <div class="card">

            <div class="header-section" style="margin-bottom: 30px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
                <h1 style="font-size: 24px;"><i class="fa-solid fa-square-plus" style="color: #566270; margin-right: 8px;"></i>Tambah Slider</h1>
            </div>

            @if ($errors->any())
                <div class="alert-danger" style="background:#fef2f2; color:#991b1b; border: 1px solid #fca5a5; padding:14px 18px; border-radius:12px; margin-bottom:20px; font-size: 14px;">
                    <ul style="margin-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('slider.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="judul">Judul Slider</label>
                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        value="{{ old('judul') }}"
                        placeholder="Masukkan judul slider"
                        required>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <label>Gambar</label>
                    
                    <div style="margin-bottom: 12px;">
                        <span style="display: block; font-size: 12px; color: #64748b; margin-bottom: 6px;">Pratinjau gambar:</span>
                        <div style="width: 150px; height: 150px; border-radius: 8px; overflow: hidden; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; background-color: #f8fafc; padding: 4px;">
                           <img id="imgPreview"
     src=""
     alt="Preview Gambar"
     style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px; display: none;">

<i id="placeholderIcon"
   class="fa-regular fa-image"
   style="font-size: 32px; color: #cbd5e1;"></i>
                        </div>
                    </div>
                <div class="form-group">
                    <label for="gambar">Upload Gambar Slider</label>
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept="image/*"
                        required
                        style="padding: 8px 12px;">
                        <small style="color: #64748b; display: block; margin-top: 4px; font-size: 12px;">
                        Format yang didukung: JPG, JPEG, PNG, atau WEBP. MAX 2MB.  
                    </small>
                </div>
                  
                <div class="form-group">
                    <label for="posisi">Posisi Tampilan</label>
                    <select id="posisi" name="posisi">
                        <option value="beranda">Beranda</option>
                        <option value="pelayanan">Pelayanan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status Publikasi</label>
                    <select id="status" name="status">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="urutan">Urutan Tampilan</label>
                    <input
                        type="number"
                        id="urutan"
                        name="urutan"
                        value="{{ old('urutan',1) }}"
                        min="1">
                </div>

               
                <div class="aksi" style="justify-content: flex-start; margin-top: 25px; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                 
                    <button type="submit" class="btn btn-add" style="background-color: #10b981;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>

                    
                    <a href="{{ route('slider.index') }}" class="btn btn-edit" style="background-color: #64748b; color: white;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

   @include('layouts.footer_table')
</div>
<script>
document.getElementById('gambar').addEventListener('change', function (e) {
    const file = e.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (event) {
            const img = document.getElementById('imgPreview');
            const icon = document.getElementById('placeholderIcon');

            img.src = event.target.result;
            img.style.display = 'block';
            icon.style.display = 'none';
        };

        reader.readAsDataURL(file);
    }
});
</script>
</body>
</html>
@endsection