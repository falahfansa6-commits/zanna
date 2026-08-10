@extends('layouts.admin')

@section('title', 'Data Product')

@section('content')
<!-- Hubungkan ke FontAwesome untuk ikon modern -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<div class="main-wrapper">
    <div class="container">
        <div class="card">
            
            <!-- Header Section -->
            <div class="header-section">
                <h1>Data Product</h1>
                <a href="{{ route('products.create') }}" class="btn btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Product
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif 

         

            <!-- Table Section -->
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="80">No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                             <th width="90">Urutan</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $item)
                        <tr>
                            <td>
                                <span class="order-number">{{ $loop->iteration }}</span>
                            </td>
                           
                            <td class="judul-text" style="text-align: left; padding-left: 20px; font-weight: 700;">
                                <i class="fa-solid fa-box" style="color: #94a3b8; margin-right: 8px;"></i>{{ $item->judul }}
                            </td>
                            <td class="text-muted-row" style="text-align: left; max-width: 400px; word-wrap: break-word;">
                                {{ Str::limit(strip_tags($item->isi), 60) }}
                            </td>

                             <td>
                                <span class="order-number" style="background: #f1f5f9; padding: 4px 10px; border-radius: 6px;">{{ $item->urutan ?? 1 }}</span>
                            </td>
                            <td>
                                <div class="aksi">
                                    <a href="{{ route('products.edit', $item->id) }}" class="btn btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>

                                    <form action="{{ route('products.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus product ini?')">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-data">
                                <i class="fa-solid fa-box-open" style="font-size: 32px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                                Data product belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="pagination-container">
                 <a href="{{ route('admin.about') }}" class="btn btn-back" style="background: #64748b; color: #fff; text-decoration: none; padding: 6px 14px; border-radius: 6px;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                 </a>
                <div class="pagination-info">Menampilkan {{ $products->count() }} data</div>
                <div class="pagination-nav">
                    <button class="btn-nav" disabled><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="btn-nav" disabled><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

        </div>
    </div>

 @include('layouts.footer_table')
</div>

@endsection