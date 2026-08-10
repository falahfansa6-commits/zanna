@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Memanggil file CSS dan Icon FontAwesome agar gaya visual form seragam -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<div class="main-wrapper">
    
    <div class="container" style="max-width: 600px;">
        
        <div class="card">
            
         
            <div class="header-section" style="border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                <h1>Tambah Gambar Our Value</h1>
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

          
            <form action="{{ route('ourvalueimage.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

              
                <div class="form-group">
                    <label for="gambar">Pilih Gambar <span style="color: #ef4444;">*</span></label>
                    <input 
                        type="file" 
                        id="gambar"
                        name="gambar" 
                        required>
                    <small class="text-muted-row" style="margin-top: 4px; display: block;">Format yang didukung: JPG, JPEG, PNG, atau WEBP. MAX 2MB.</small>
                </div>

              
                <div class="aksi" style="justify-content: flex-start; margin-top: 25px; gap: 10px;">
                    <button type="submit" class="btn btn-add" style="background: #10b981;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Data
                    </button>
                    <a href="{{ route('ourvalueimage.index') }}" class="btn btn-edit" style="background: #64748b; color: white;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@include('layouts.footer_table')
@endsection