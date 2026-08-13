@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')

<!-- FontAwesome & Custom CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<div class="main-wrapper">
    <div class="container">
        
        <div class="card">
            
            <!-- Header Utama -->
            <div class="header-section">
                <h1>Data Gambar Produk</h1>
                <a href="{{ route('theprodukimage.create') }}" class="btn btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Gambar
                </a>
            </div>

            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i> 
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Table Wrapper Responsive -->
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">No</th>
                            <th>Gambar</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gambar as $item)
                            <tr>
                                <td>
                                    <span class="order-number">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <!-- Preview Gambar -->
                                    <div class="img-preview-box">
                                        @if($item->gambar)
                                            <img src="{{ asset($item->gambar) }}" alt="Gambar Produk">
                                        @else
                                            <div class="no-image">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <!-- Aksi Edit & Delete -->
                                    <div class="aksi">
                                        <a href="{{ route('ourvalueimage.edit', $item->id) }}" class="btn btn-edit">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>

                                        <form action="{{ route('theprodukimage.destroy', $item->id) }}" method="POST">
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
                                <td colspan="3" class="empty-data">
                                    <i class="fa-regular fa-folder-open" style="font-size: 40px; display: block; margin-bottom: 10px;"></i>
                                    Belum ada data gambar produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

         
            <div style="margin-top: 25px;">
                  <br>
<a href="{{ route('admin.layanan') }}" class="btn btn-back" style="background: #64748b; color: #fff;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
            </div>

        </div>
    </div>
</div>

@include('layouts.footer_table')

@endsection