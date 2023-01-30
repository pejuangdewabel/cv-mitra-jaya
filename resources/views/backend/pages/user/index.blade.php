@extends('backend.layouts.app')
@push('after-link')
@endpush
@section('content')
    <div class="pagetitle">
        <h1>USER | SISTEM MANAJEMEN PEMESANAN CV MITRA JAYA</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card top-selling">
                        <div class="card-body pb-0">
                            <div class="card-title">
                                {{-- <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle"></i>
                                    Tambah Data
                                </a> --}}
                                DATA USER
                            </div>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No Telp</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataUser as $dU)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dU->email }}</td>
                                            <td>{{ $dU->nama }}</td>
                                            <td>{{ $dU->no_telp }}</td>
                                            <td>
                                                @if ($dU->alamat != null)
                                                    {{ $dU->alamat }}
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                            <td>
                                                @if ($dU->status == 1)
                                                    <span class="badge bg-primary">Aktif</span>
                                                @elseif($dU->status == 2)
                                                    <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>{{ $dU->level }}</td>
                                            <td>
                                                @if ($dU->foto != null)
                                                    <img src="{{ Storage::url($dU->foto) }}" class="img-thumbnail"
                                                        style="max-width: 100px !important">
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('user.edit', Crypt::encryptString($dU->id)) }}"
                                                    class="btn btn-warning">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <br>
                                                <br>
                                                <form action="{{ route('user.destroy', Crypt::encryptString($dU->id)) }}"
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
