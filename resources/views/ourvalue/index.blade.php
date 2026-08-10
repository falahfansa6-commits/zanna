@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<!-- Memanggil file CSS dan Icon FontAwesome agar gaya visual seragam -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<div class="main-wrapper">
    <div class="container">
        
        <!-- Notifikasi Sukses memanfaatkan class bawaan css -->
        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card">
            
            <!-- Header Section diselaraskan dengan class css asli -->
            <div class="header-section">
                <h1>Data Our Value</h1>
                
                <!-- Tombol Tambah Data disesuaikan dengan warna tema .btn-add -->
                <a href="{{ route('ourvalues.create') }}" class="btn btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Data
                </a>
            </div>

            <!-- Pembungkus responsif dan tabel admin-table agar layout seragam -->
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th width="80">Urutan</th>
                            <th width="120">Status</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ourvalues as $item)
                        <tr>
                            <!-- Kolom No -->
                            <td>{{ $loop->iteration }}</td>
                            
                            <!-- Judul menggunakan class teks tebal bawaan -->
                            <td class="judul-text">{{ $item->judul }}</td>
                            
                            <!-- Kolom Deskripsi dengan memanfaatkan class baris teks bawaan -->
                           <td  class="pts-right-description">
                            {!! $item->isi !!}
                               </td>
                            
                            <!-- Kolom Urutan -->
                            <td>{{ $item->urutan }}</td>
                            
                            <!-- Kolom Status memanfaatkan kondisi class badge bawaan -->
                            <td>
                                <span class="badge {{ $item->status ? 'badge-success' : 'badge-danger' }}">
                                    {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            
                            <!-- Kolom Aksi dengan tombol Edit & Hapus -->
                            <td>
                                <div class="aksi">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('ourvalues.edit', $item->id) }}" class="btn btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus dengan class .btn-delete asli -->
                                    <form action="{{ route('ourvalues.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <!-- Menampilkan pesan kosong jika data nihil -->
                            <td colspan="6" class="empty-data">
                                <i class="fa-solid fa-lightbulb"></i>
                                Belum ada data value yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
            <br>
<a href="{{ route('admin.dashboard') }}" class="btn btn-back" style="background: #64748b; color: #fff;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
        </div>
    </div>
</div>

@include('layouts.footer_table')

@endsection