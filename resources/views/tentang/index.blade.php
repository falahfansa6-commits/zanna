<!DOCTYPE html>
<html lang="en">
<head>
    @extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Tentang Kami</title>
    <!-- Hubungkan ke FontAwesome untuk ikon modern -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
</head>
<body>

<div class="main-wrapper">
    <div class="container">
        <div class="card">
            
           
            <div class="header-section">
                <h1>Data Tentang Kami</h1>
                <a href="{{ route('tentang.create') }}" class="btn btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Data
                </a>
            </div>

            
            @if(session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif  

            {{-- <!-- Utilities: Search & Bulk Actions -->
            <div class="utilities-bar">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" placeholder="Cari data...">
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
                            <th width="80">No</th>
                            <th width="180">Gambar</th>
                            <th>Judul</th>
                            <th>Isi Konten</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tentang as $item)
                        <tr>
                            <td>
                                <span class="order-number">{{ $loop->iteration }}</span>
                            </td>
                            <td>
                                @if($item->gambar)
                                    <div class="image-wrapper">
                                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="preview">
                                        <!-- Quick Edit Button Overlay -->
                                        <a href="{{ route('tentang.edit',$item->id) }}" class="quick-edit-overlay">
                                            <i class="fa-solid fa-pen"></i>
                                            <span>Edit</span>
                                        </a>
                                    </div>
                                @else
                                    <span class="no-image"><i class="fa-solid fa-image"></i></span>
                                @endif
                            </td>
                            <td class="judul-text" style="text-align: left; padding-left: 15px;">
                                {{ $item->judul }}
                            </td>
           <td class="text-muted-row" style="text-align: left; max-width: 350px; word-wrap: break-word;">
    {!! $item->isi !!}
</td>
                            <td>
                                <div class="aksi">
                                    <a href="{{ route('tentang.edit',$item->id) }}" class="btn btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>

                                    <form action="{{ route('tentang.destroy',$item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin hapus data?')">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-data">
                                <i class="fa-solid fa-address-card" style="font-size: 32px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                                Data belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

          
            <div class="pagination-container">
                <a href="{{ route('admin.about') }}" class="btn btn-back" style="background: #64748b; color: #fff;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                <div class="pagination-info">Menampilkan {{ $tentang->count() }} data</div>
                <div class="pagination-nav">
                    <button class="btn-nav" disabled><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="btn-nav" disabled><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

        </div>
    </div>

   @include('layouts.footer_table')
</div>

</body>
</html>
@endsection