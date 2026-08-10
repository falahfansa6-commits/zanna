@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')

<!-- Memanggil file CSS dan Icon FontAwesome agar gaya visual form seragam -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<div class="main-wrapper">
   
    <div class="container" style="max-width: 600px;">
        
        <div class="card">
            
        
            <div class="header-section" style="border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                <h1>Tambah Gambar The Produk</h1>
            </div>

          
            @if($errors->any())
                <div class="alert-danger">
                    <p style="margin: 0; font-weight: bold;">
                        <i class="fa-solid fa-triangle-exclamation"></i> Harap perbaiki kesalahan pengisian form di bawah ini.
                    </p>
                </div>
            @endif

            
            <form action="{{ route('theprodukimage.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

               
                <div class="form-group">
                    <label for="gambar">Pilih Gambar <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="file" 
                        id="gambar" 
                        name="gambar"
                        class="@error('gambar') is-invalid @enderror"
                        required>
                    <small class="text-muted-row" style="margin-top: 4px; display: block;">Format yang didukung: JPG, JPEG, PNG, atau WEBP.</small>
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