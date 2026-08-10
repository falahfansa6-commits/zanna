@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')

<!-- Memanggil file CSS dan Icon FontAwesome agar gaya visual form seragam -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<div class="main-wrapper">
    <!-- Menggunakan batas max-width kecil agar layout form tetap proporsional -->
    <div class="container" style="max-width: 600px;">
        
        <div class="card">
            
            <!-- Bagian Header Form -->
            <div class="header-section" style="border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                <h1>Edit Gambar The Produk</h1>
            </div>

            <!-- Blok Pesan Error Validasi Global -->
            @if($errors->any())
                <div class="alert-danger">
                    <p style="margin: 0; font-weight: bold;">
                        <i class="fa-solid fa-triangle-exclamation"></i> Harap perbaiki kesalahan pengisian form di bawah ini.
                    </p>
                </div>
            @endif

          
            <form action="{{ route('theprodukimage.update', $theprodukimage->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                
                <div class="form-group">
                    <label>Gambar Saat Ini</label>
                    <div class="img-preview-box" style="width: 200px; height: 200px; margin-top: 5px;">
                        @if($theprodukimage->gambar)
                            <img src="{{ asset($theprodukimage->gambar) }}" alt="Preview Gambar Saat Ini">
                        @else
                            <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #94a3b8; background: #f8fafc;">
                                <i class="fa-regular fa-image" style="font-size: 32px;"></i>
                            </div>
                        @endif
                    </div>
                </div>

              
                <div class="form-group">
                    <label for="gambar">Pilih Gambar Baru</label>
                    <input 
                        type="file" 
                        id="gambar" 
                        name="gambar"
                        class="@error('gambar') is-invalid @enderror">
                    <small class="text-muted-row" style="margin-top: 4px; display: block;">Format yang didukung: JPG, JPEG, PNG, atau WEBP MAX 2MB.</small>
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

                  
                    <a href="{{ route('theprodukimage.index') }}" class="btn btn-edit" style="background-color: #64748b; color: white;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
    @include('layouts.footer_table')
</div>

@endsection