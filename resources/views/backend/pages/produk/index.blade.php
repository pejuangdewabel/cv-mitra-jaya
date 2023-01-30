@extends('backend.layouts.app')
@push('after-link')
@endpush
@section('content')
    <div class="pagetitle">
        <h1>PRODUK | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card top-selling">
                        <div class="card-body pb-0">
                            <div class="card-title">
                                <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i>
                                    Tambah Data
                                </a>
                            </div>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kategori Produk</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Waktu Pengerjaan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataProduk as $dP)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dP->relasi_kategori->nama }}</td>
                                            <td>{{ $dP->nama }}</td>
                                            <td>{{ $dP->waktu_pengerjaan }} Hari</td>
                                            <td>
                                                @if ($dP->status == 1)
                                                    <span class="badge bg-primary">Aktif</span>
                                                @elseif($dP->status == 2)
                                                    <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{ Storage::url($dP->foto) }}" class="img-thumbnail"
                                                    style="max-width: 200px !important">
                                            </td>
                                            <td>
                                                <a href="{{ route('produk.show', Crypt::encryptString($dP->id)) }}"
                                                    class="btn btn-success" title="Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <br>
                                                <br>
                                                <a href="{{ route('produk.edit', Crypt::encryptString($dP->id)) }}"
                                                    class="btn btn-warning">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <br>
                                                <br>
                                                <form action="{{ route('produk.destroy', Crypt::encryptString($dP->id)) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('after-script')
@endpush
