@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')

<!-- Menggunakan stylesheet slider.css dan ikon FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<div class="main-wrapper">
    <div class="container">

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="alert-success">
                <p style="margin: 0; font-weight: bold;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </p>
            </div>
        @endif

        <div class="card">

            <!-- Bagian Header Tabel -->
            <div class="header-section" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; gap: 15px; flex-wrap: wrap; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
                <div>
                    <h2 style="margin: 0;">Data Layanan</h2>
                    <p style="margin: 5px 0 0 0; color: #64748b; font-size: 14px;">Kelola daftar dan urutan data layanan Anda.</p>
                </div>
                
                <!-- Tombol Tambah Data -->
                <a href="{{ route('service.create') }}" class="btn btn-add" style="display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-plus"></i> Tambah Data
                </a>
            </div>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="80">No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th width="120" style="text-align: center;">Urutan</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                        <tr>
                            <!-- Kolom No -->
                            <td style="font-weight: 600;">{{ $loop->iteration }}</td>

                            <!-- Kolom Judul -->
                            <td style="font-weight: 600; color: #1e293b;">
                                {{ $service->judul }}
                            </td>

                            <!-- Kolom Deskripsi -->
                            <td style="color: #64748b;" class="pts-right-description">
                             {!! $service->isi !!}
                            </td>

                            <!-- Kolom Urutan -->
                            <td style="text-align: center;">
                                <span style="background-color: #f1f5f9; padding: 4px 10px; border-radius: 20px; font-size: 13px; border: 1px solid #e2e8f0; display: inline-block; font-weight: 600;">
                                    {{ $service->urutan }}
                                </span>
                            </td>

                            <!-- Kolom Aksi -->
                            <td>
                                <div class="aksi" style="display: flex; gap: 8px; justify-content: flex-start;">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('service.edit', $service->id) }}" class="btn btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('service.destroy', $service->id) }}" method="POST" style="margin: 0; display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #64748b; padding: 30px 20px;">
                                <i class="fa-regular fa-folder-open" style="font-size: 24px; margin-bottom: 8px; display: block; color: #cbd5e1;"></i>
                                Belum ada data layanan saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <br> 
  <a href="{{ route('admin.layanan') }}" class="btn btn-back" style="background: #64748b; color: #fff;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
        </div>
    </div>
</div>
@include('layouts.footer_table')

@endsection