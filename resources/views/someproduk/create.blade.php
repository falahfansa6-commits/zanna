@extends('layouts.admin')

@section('content')

<div class="container">

    <h2>Tambah Some Product</h2>

    <form action="{{ route('someproduct.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label>Judul</label>

            <input
                type="text"
                name="judul"
                class="form-control"
                value="{{ old('judul') }}">
        </div>

        <div class="mb-3">
            <label>Isi</label>

            <textarea
                name="isi"
                rows="5"
                class="form-control">{{ old('isi') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Urutan</label>

            <input
                type="number"
                name="urutan"
                class="form-control"
                value="{{ old('urutan') }}">
        </div>

        <div class="mb-3">
            <label>Gambar</label>

            <input
                type="file"
                name="gambar"
                class="form-control">
        </div>

        <button class="btn btn-primary">
            Simpan
        </button>

        <a href="{{ route('someproduct.index') }}"
            class="btn btn-secondary">
            Kembali
        </a>

    </form>
@include('layouts.footer_table')
</div>

@endsection