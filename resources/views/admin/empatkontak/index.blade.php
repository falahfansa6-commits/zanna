@extends('layouts.admin')

@section('title', 'Hubungi Kami')

@section('content')

<!-- Memanggil file CSS dan Icon FontAwesome agar gaya visual seragam -->
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
                <h1>Data Empat Kontak</h1>

                <a href="{{ route('empat-kontak.create') }}" class="btn btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Kontak
                </a>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="150">Judul</th>
                            <th>Isi Kontak</th>
                            <th>Teks Link</th>
                            <th>Link</th>
                            <th>Urutan</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($empatkontaks as $kontak)
                        <tr>

                            <td class="judul-text">
                                {{ $kontak->judul }}
                            </td>

                            <td  class="pts-right-description">
                                {!! $kontak->isi !!}
                            </td>
                              
                            <td class="text-muted-row">  
                                {{ $kontak->text_link }}
                            </td>

                            <td class="link-row">
                                <a href="{{ $kontak->link }}" target="_blank">
                                    <i class="fa-solid fa-link"></i> Link Tautan
                                </a>
                            </td>

                            <td>
                                <span class="order-number">
                                    {{ $kontak->urutan }}
                                </span>
                            </td>

                            <td>
                                <div class="aksi">

                                    <a href="{{ route('empat-kontak.edit', $kontak->id) }}" class="btn btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>

                                    <form action="{{ route('empat-kontak.destroy', $kontak->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus kontak ini?')">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="empty-data">
                                <i class="fa-regular fa-address-book"></i>
                                Belum ada data kontak.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <br>

            <a href="{{ route('admin.hubkontak') }}" class="btn btn-back" style="background:#64748b;color:#fff;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>

        </div>
    </div>

   @include('layouts.footer_table')

</div>

@endsection