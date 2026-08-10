@extends('layouts.admin')

@section('title', 'Secound')

@section('content')

<!-- Memanggil file CSS dan Icon FontAwesome agar visual tabel admin seragam -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<div class="main-wrapper">
    <div class="container">
        
        <!-- Notifikasi Sukses dengan gaya alert modern -->
        @if(session('success'))
            <div class="alert-success" style="margin-bottom: 20px;">
                <p style="margin: 0; font-weight: bold;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </p>
            </div>
        @endif

        <div class="card">
            
            <!-- Header Section diselaraskan dengan halaman admin lainnya -->
            <div class="header-section" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px; gap: 15px; flex-wrap: wrap;">
                <div>
                    <h2 style="margin: 0;">Data Secound</h2>
                    <p style="margin: 5px 0 0 0; color: #64748b; font-size: 14px;">Kelola data konten visual, judul, dan deskripsi pendukung.</p>
                </div>
                
                <!-- Tombol Tambah Data -->
                <a href="{{ route('secound.create') }}" class="btn btn-add" style="display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-plus"></i> Tambah Data
                </a>
            </div>

            <!-- Pembungkus responsif dan tabel admin-table agar layout seragam -->
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="80">No</th>
                            <th width="120">Gambar</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($secounds as $item)
                        <tr>
                           
                            <td style="font-weight: 600;">{{ $loop->iteration }}</td>
                            
                          
                            <td>
                                <div style="width: 80px; height: 80px; border-radius: 8px; overflow: hidden; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; background-color: #f8fafc;">
                                    @if($item->gambar)
                                        <img src="{{ asset('uploads/secound/' . $item->gambar) }}" alt="{{ $item->judul }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <i class="fa-regular fa-image" style="font-size: 20px; color: #cbd5e1;"></i>
                                    @endif
                                </div>
                            </td>
                            
                     
                            <td style="font-weight: 600; color: #1e293b;">{{ $item->judul }}</td>
                            
                          
                            <td style="color: #64748b;" class="pts-right-description">
                            
                           {!! $item->isi !!}

                            </td>
                            
                       
                            <td>
                                <div class="aksi" style="display: flex; gap: 8px; justify-content: flex-start;">
                                  
                                    <a href="{{ route('secound.edit', $item->id) }}" class="btn btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>

                              
                                    <form action="{{ route('secound.destroy', $item->id) }}" method="POST" style="margin: 0; display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                                Data belum tersedia.
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