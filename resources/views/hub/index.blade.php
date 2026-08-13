@extends('layouts.admin')

@section('title', 'Hubungi Kami')

@section('content')

<!-- Menggunakan stylesheet slider.css dan ikon FontAwesome untuk keseragaman visual -->
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
            <div class="header-section" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
                <div>
                    <h2 style="margin: 0;">Data Hubungi Kami</h2>
                    <p style="margin: 5px 0 0 0; color: #64748b; font-size: 14px;">Melihat dan mengelola pesan masuk dari pengguna.</p>
                </div>
            </div>

            <!-- Tabel Data Responsif -->
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama</th>
                            <th>No WhatsApp</th>
                            <th>Email</th>
                            <th>Pesan</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hub_kami as $item)
                        <tr>
                            <!-- Kolom No -->
                            <td style="font-weight: 600;">{{ $loop->iteration }}</td>

                            <!-- Kolom Nama -->
                            <td style="font-weight: 600; color: #1e293b;">{{ $item->nama }}</td>

                            <!-- Kolom No WhatsApp -->
                            <td>
                                <a href="https://wa.me/+62{{ preg_replace('/[^0-9]/', '', $item->no_wa) }}" target="_blank" style="color: #10b981; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                    <i class="fa-brands fa-whatsapp"></i> {{ $item->no_wa }}
                                </a>
                            </td>

                            <!-- Kolom Email -->
                            <td style="color: #64748b;">{{ $item->email }}</td>

                            <!-- Kolom Pesan / Deskripsi -->
                            <td style="color: #475569;">
                                {{ \Illuminate\Support\Str::limit($item->isi, 100) }}
                            </td>

                            <!-- Kolom Aksi -->
                            <td>
                                <div class="aksi" style="display: flex; gap: 8px; justify-content: flex-start;">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('hub_kami.edit', $item->id) }}" class="btn btn-edit">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('hub_kami.destroy', $item->id) }}" method="POST" style="margin: 0; display: inline;">
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
                            <td colspan="6" style="text-align: center; color: #64748b; padding: 30px 20px;">
                                <i class="fa-regular fa-envelope-open" style="font-size: 24px; margin-bottom: 8px; display: block; color: #cbd5e1;"></i>
                                Belum ada data pesan masuk saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
 <br>
  <a href="{{ route('admin.hubkontak') }}" class="btn btn-back" style="background: #64748b; color: #fff;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
        </div>
    </div>
</div>


@include('layouts.footer_table')

@endsection