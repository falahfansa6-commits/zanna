@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/slider.css') }}">

<div class="main-wrapper">
    <div class="container">
        
      
        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card">
            
           
            <div class="header-section">
                <h1>Data Our Value</h1>
                
              
                <a href="{{ route('ourvalues.create') }}" class="btn btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Data
                </a>
            </div>

          
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
                         
                            <td>{{ $loop->iteration }}</td>
                            
                         
                            <td class="judul-text">{{ $item->judul }}</td>
                            
                        
                           <td  class="pts-right-description">
                            {!! $item->isi !!}
                               </td>
                            
                          
                            <td>{{ $item->urutan }}</td>
                            
                          
                            <td>
                                <span class="badge {{ $item->status ? 'badge-success' : 'badge-danger' }}">
                                    {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            
                           
                            <td>
                                <div class="aksi">
                                    
                                    <a href="{{ route('ourvalues.edit', $item->id) }}" class="btn btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>

                                  
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