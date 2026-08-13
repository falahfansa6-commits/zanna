<!DOCTYPE html>
<html lang="en">
<head>
    @extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Lokasi</title>
    <!-- Hubungkan ke FontAwesome untuk ikon modern -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
</head>
<body>

<div class="main-wrapper">
    <div class="container">
        <div class="card">
            
            <!-- Header Section -->
            <div class="header-section">
                <h1>Data Lokasi</h1>
                <a href="{{ route('location.create') }}" class="btn btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Lokasi
                </a>
            </div>

            
            @if(session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif  

         
            <div class="utilities-bar">
                <div class="search-box">
                    <form action="{{ route('location.index') }}" method="GET">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" placeholder="Cari lokasi..." name="q">
                    </form>
                </div>
                {{-- <div class="dropdown-box">
                    <button class="btn-dropdown">
                        Bulk Actions <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>
                </div> --}}
            </div>

            <!-- Table Section -->
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="80">No</th>
                            <th>Nama Kota</th>
                            <th>Alamat</th>
                            <th>LINK MAPS</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $location)
                        <tr>
                            <td>
                                <span class="order-number">{{ $loop->iteration }}</span>
                            </td>
                            <td class="judul-text" style="text-align: left; padding-left: 25px;">
                                <i class="fa-solid fa-city" style="color: #94a3b8; margin-right: 8px;"></i>{{ $location->nama_kota }}
                            </td>
                            <td class="text-muted-row" style="text-align: left; max-width: 400px; word-wrap: break-word;">
                              
                            {!! $location->alamat !!}

                            </td>
                            <td class="link-row">
                                <a href="{{ $location->ling }}" target="_blank">
                                    <i class="fa-solid fa-link"></i> Link Tautan
                                </a>
                            </td>
                            <td>
                                <div class="aksi">
                                    <a href="{{ route('location.edit', $location->id) }}" class="btn btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>

                                    <form action="{{ route('location.destroy', $location->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus lokasi ini?')">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="empty-data">
                                <i class="fa-solid fa-map-location-dot" style="font-size: 32px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                                Data lokasi belum tersedia.
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
                <div class="pagination-info">Menampilkan {{ $locations->count() }} data</div>
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