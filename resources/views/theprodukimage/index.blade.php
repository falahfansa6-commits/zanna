@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<div class="main-wrapper">
    <div class="container">
        
        <div class="card">
            
         
            <div class="header-section">
                <h1>Data Gambar The Produk</h1>
             
                <a href="{{ route('theprodukimage.create') }}" class="btn btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Gambar
                </a>
            </div>

        
            @if(session('success'))
                <div class="alert-success">
                    <p style="margin: 0; font-weight: bold;">
                        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                    </p>
                </div>
            @endif

        
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 80px; text-align: center;">No</th>
                        <th>Gambar</th>
                        <th style="width: 200px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gambar as $item)
                        <tr>
                            <td style="text-align: center; font-weight: 600;">{{ $loop->iteration }}</td>
                            <td>
                               
                                <div class="img-preview-box" style="width: 100px; height: 100px; margin: 0;">
                                    @if($item->gambar)
                                        <img src="{{ asset($item->gambar) }}" alt="Gambar Produk">
                                    @else
                                        <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #94a3b8; background: #f8fafc;">
                                            <i class="fa-regular fa-image" style="font-size: 24px;"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                
                                <div class="aksi" style="justify-content: center; gap: 8px;">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('theprodukimage.edit', $item->id) }}" class="btn btn-edit">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>

                                
                                    <form action="{{ route('theprodukimage.destroy', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: #94a3b8; padding: 30px 10px;">
                                <i class="fa-regular fa-folder-open" style="font-size: 40px; display: block; margin-bottom: 10px; color: #cbd5e1;"></i>
                                Belum ada data gambar produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
 <br>
  <a href="{{ route('admin.layanan') }}" class="btn btn-back" style="background: #64748b; color: #fff;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
        </div>
    </div>
</div>
@include('layouts.footer_table')
@endsection