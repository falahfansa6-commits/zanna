<!DOCTYPE html>
<html lang="en">
<head>
    @extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Slider</title>
    <!-- Tambahkan CDN FontAwesome untuk ikon tombol -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
</head>
<body>

<div class="main-wrapper">
    <div class="container" style="max-w: 800px;"> <!-- Membatasi lebar form agar lebih rapi -->
        <div class="card">
            
            <div class="header-section" style="margin-bottom: 30px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
                <h1 style="font-size: 24px;"><i class="fa-solid fa-pen-to-square" style="color: #566270; margin-right: 8px;"></i>Edit Slider</h1>
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

            <form action="{{ route('slider.update',$slider->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul">Judul Slider</label>
                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        value="{{ old('judul',$slider->judul) }}"
                        placeholder="Masukkan judul slider"
                        required>
                </div>

                <div class="form-group">
                    <label for="posisi">Posisi Tampilan</label>
                    <select id="posisi" name="posisi">
                        <option value="beranda"
                            {{ old('posisi',$slider->posisi)=='beranda' ? 'selected' : '' }}>
                            Beranda
                        </option>
                        <option value="pelayanan"
                            {{ old('posisi',$slider->posisi)=='pelayanan' ? 'selected' : '' }}>
                            Pelayanan
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status Publikasi</label>
                    <select id="status" name="status">
                        <option value="1"
                            {{ old('status',$slider->status)==1 ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="0"
                            {{ old('status',$slider->status)==0 ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="urutan">Urutan Tampilan</label>
                    <input
                        type="number"
                        id="urutan"
                        name="urutan"
                        min="1"
                        value="{{ old('urutan',$slider->urutan) }}">
                </div>

                <div class="form-group">
                    <label>Gambar Saat Ini</label>
                    <div class="image-preview" style="display: flex; justify-content: flex-start; margin-top: 10px;">
                        <div class="image-wrapper" style="width: 200px; height: 112px; margin: 0;">
                            <img src="{{ asset('uploads/slider/'.$slider->gambar) }}"
                                 alt="Slider"
                                 class="preview">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gambar">Ganti File Gambar Baru</label>
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept="image/*"
                        style="padding: 8px 12px;">
                    <small class="text-muted" style="color: #64748b; font-size: 13px; display: block; mt: 6px;">
                        <i class="fa-solid fa-circle-info"></i>Format yang di dukung jpg,jpeg,png,webp. MAX 2MB.
                    </small>
                </div>

                <!-- Bagian Tombol Aksi / Menggunakan wrapper .aksi bawaan slider.css -->
                <div class="aksi" style="justify-content: flex-start; margin-top: 25px; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                    <!-- Tombol Simpan -->
                    <button type="submit" class="btn btn-add" style="background-color: #10b981;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>

                    <!-- Tombol Kembali -->
                    <a href="{{ route('slider.index') }}" class="btn btn-edit" style="background-color: #64748b; color: white;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

    <!-- Footer Konsisten -->
    <footer class="main-footer">
        <div class="footer-links">
            <a href="#">Dokumentasi</a>
            <a href="#">Bantuan</a>
            <a href="#">Cantast hara</a>
        </div>
        <div class="footer-copyright">
            &copy; 2026 Admin. Intex
        </div>
    </footer>
</div>

</body>
</html>
@endsection