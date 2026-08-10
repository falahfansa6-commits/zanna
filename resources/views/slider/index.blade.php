@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<!-- Tambahkan CDN FontAwesome jika belum ada di file layout utama Anda -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<div class="main-wrapper">
    <div class="container">
        <div class="card">
            
            <!-- Header Section -->
            <div class="header-section">
                <h1>Data Slider</h1>
                <a href="{{ route('slider.create') }}" class="btn btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Slider
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif  

            <!-- Utilities: Search & Bulk Actions -->
            {{-- <div class="utilities-bar">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" placeholder="Cari slider...">
                </div>
                <div class="dropdown-box">
                    <button class="btn-dropdown">
                        Bulk Actions <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>
                </div>
            </div> --}}

            <!-- Table Section -->
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Gambar</th>
                            <th>Posisi</th>
                            <th>Status</th>
                            <th>Urutan</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                        <tr>
                            <td class="judul-text">{{ $slider->judul }}</td>
                            <td>
                                @if($slider->gambar)
                                    <div class="image-wrapper">
                                        <img src="{{ asset('uploads/slider/'.$slider->gambar) }}" alt="{{ $slider->judul }}" class="preview">
                                        
                                        <a href="{{ route('slider.edit',$slider->id) }}" class="quick-edit-overlay">
                                            <i class="fa-solid fa-pen"></i>
                                            <span>Edit</span>
                                        </a>
                                    </div>
                                @else
                                    <span class="no-image"><i class="fa-solid fa-image"></i></span>
                                @endif
                            </td>
                            <td class="text-muted-row">{{ ucfirst($slider->posisi) }}</td>
                            <td>
                                @if($slider->status)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <span class="order-number">{{ $slider->urutan }}</span>
                            </td>
                            <td>
                                <div class="aksi">
                                    <a href="{{ route('slider.edit',$slider->id) }}" class="btn btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>

                                    <form action="{{ route('slider.destroy',$slider->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus slider ini?')">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="empty-data">
                                <i class="fa-solid fa-folder-open block mb-2" style="font-size: 24px; color: #ccc;"></i><br>
                                Belum ada data slider.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>

          
            <div class="pagination-container">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-back" style="background: #64748b; color: #fff;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                <div class="pagination-info">1-2 of 50</div>
                <div class="pagination-nav">
                    <button class="btn-nav" disabled><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="btn-nav"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

        </div>
    </div>


    @include('layouts.footer_table')
</div>
@endsection