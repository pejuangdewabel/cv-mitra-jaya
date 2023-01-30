@extends('backend.layouts.app')
@push('after-link')
@endpush
@section('content')
    <div class="pagetitle">
        <h1>KARYAWAN | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card top-selling">
                        <div class="card-body pb-0">
                            <div class="card-title">
                                <a href="{{ route('karyawan.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i>
                                    Tambah Data
                                </a>
                            </div>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataKaryawan as $dK)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dK->username }}</td>
                                            <td>{{ $dK->nama }}</td>
                                            <td>
                                                @if ($dK->level == 1)
                                                    ADMIN
                                                @elseif ($dK->level == 2)
                                                    OPERATOR
                                                @elseif($dK->level == 3)
                                                    PIMPINAN
                                                @endif
                                            </td>
                                            <td>
                                                @if ($dK->status == true)
                                                    <span class="badge bg-primary">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($dK->foto != null)
                                                    <img src="{{ Storage::url($dK->foto) }}" alt="" srcset="">
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('karyawan.edit', Crypt::encryptString($dK->id)) }}"
                                                    class="btn btn-warning">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <br>
                                                <br>
                                                <form
                                                    action="{{ route('karyawan.destroy', Crypt::encryptString($dK->id)) }}"
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
