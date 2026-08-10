@extends('layouts.admin')

@section('content')

<div class="container">

    <h2>Edit Some Product</h2>

    <form action="{{ route('someproduct.update', ['someproduct' => $someProduct->id]) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Judul</label>

            <input
                type="text"
                name="judul"
                class="form-control"
                value="{{ old('judul',$someProduct->judul) }}">

        </div>

        <div class="mb-3">

            <label>Isi</label>

            <textarea
                name="isi"
                rows="5"
                class="form-control">{{ old('isi',$someProduct->isi) }}</textarea>

        </div>

        <div class="mb-3">

            <label>Urutan</label>

            <input
                type="number"
                name="urutan"
                class="form-control"
                value="{{ old('urutan',$someProduct->urutan) }}">

        </div>

        <div class="mb-3">

            <label>Gambar Saat Ini</label>

            <br>

            <img
                src="{{ asset('uploads/some/'.$someProduct->gambar) }}"
                width="180">

        </div>

        <div class="mb-3">

            <label>Ganti Gambar</label>

            <input
                type="file"
                name="gambar"
                class="form-control">

        </div>

        <!-- Bagian Tombol Aksi / Menggunakan wrapper .aksi bawaan slider.css -->
                <div class="aksi" style="justify-content: flex-start; margin-top: 25px; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                    <!-- Tombol Simpan -->
                    <button type="submit" class="btn btn-add" style="background-color: #10b981;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>

                    <!-- Tombol Kembali -->
                    <a href="{{ route('someproduct.index') }}" class="btn btn-edit" style="background-color: #64748b; color: white;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </div>

    </form>

</div>

@endsection