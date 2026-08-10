@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h2>Data Some Product</h2>

        <a href="{{ route('someproduct.create') }}" class="btn btn-primary">
            Tambah Data
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="60">No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Urutan</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($someProducts as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>

                <td width="120">
                    <img src="{{ asset('uploads/some/'.$item->gambar) }}"
                        width="100">
                </td>

                <td>{{ $item->judul }}</td>

                <td>{{ $item->isi }}</td>

                <td>{{ $item->urutan }}</td>

                <td>

                    <a href="{{ route('someproduct.edit', ['someproduct' => $item->id]) }}"
                        class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('someproduct.destroy', ['someproduct' => $item->id]) }}"
                        method="POST"
                        style="display:inline-block">

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Yakin ingin menghapus data?')"
                            class="btn btn-danger btn-sm">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="6" class="text-center">
                    Data belum tersedia.
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@include('layouts.footer_table')
@endsection