@extends('frontend.layouts.app-home', ['about', 'metodePembayaran'])
@push('after-link')
@endpush

@section('content1')
    <div class="hero">
        <div class="hero-headline">
            <span class="text-gradient-blue"> CV MITRA
                JAYA</span> <br class="d-none d-lg-block" />
        </div>
        <p class="hero-paragraph"> Pelayanan jasa kami pencetakan produk.
            <br>
            Pekerjaan kami dilakukan oleh tenaga profesional yang ahli dalam bidang
            nya.
        </p>
        <div class="row">
            <div class="col-md-12">
                <a href="#grow-today" class="btn-green">
                    CARI PRODUK
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row flex-nowrap justify-content-center align-items-center gap-5 header-image">
        <img src="{{ Storage::url($about->hero) }}" alt="img-hero" class="img-2" />
        {{-- 'assets/frontend/images/hero/hero.png' --}}
    </div>
@endsection

@section('content')
    <section class="brand-partner text-center">
        <h3 class="text-gradient-blue">KATEGORI PRODUK</h3>
        <br class="d-none d-md-block" />
        <div class="d-flex flex-row flex-wrap justify-content-center align-items-center">
            @foreach ($kategori as $k)
                <img src="{{ Storage::url($k->icon) }}" style="max-width: 100px !important" title="{{ $k->nama }}">
            @endforeach

            {{-- <a href="http://" data-toggle="tooltip" data-placement="bottom" title="Some Text!">
                <img src="{{ asset('assets/frontend/images/Logo-new/books.png') }}">
            </a>
            <a href="http://" data-toggle="tooltip" data-placement="bottom" title="Some Text!">
                <img src="{{ asset('assets/frontend/images/Logo-new/books.png') }}">
            </a> --}}
            {{-- <p class="text-gradient-blue">Industri Percetakan</p> --}}
            {{-- <img src="{{ asset('assets/frontend/images/google-2015.svg') }}" alt="semina" /> --}}
        </div>
    </section>

    <section class="grow-today">
        <div class="container">
            <div class="sub-title mb-1" id="grow-today">
                <span class="text-gradient-pink">PRODUK KAMI</span>
            </div>
            <div class="title">
                Berbagai macam produk percetakan
            </div>
            <div class="mt-5 row gap">
                @foreach ($produk as $p)
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card-grow h-100">
                            <span class="badge-pricing">{{ format_uang($p->price) }}</span>
                            <img src="{{ Storage::url($p->produk->foto) }}" alt="semina" />
                            <div class="card-content">
                                <div class="card-title">
                                    {{ $p->desc }}
                                </div>
                                <div class="card-subtitle">
                                    {{ $p->produk->relasi_kategori->nama }}
                                </div>
                                {{-- <div class="description">
                                    Terjual : {{ App\DetailTransaksi::where('produk_id', $p->produk_id)->sum('jumlah') }}
                                </div> --}}
                                <div class="description">
                                    Waktu Pengerjaan : {{ $p->produk->waktu_pengerjaan }} hari
                                </div>
                                <div class="description" style="text-align: justify;">
                                    <br>
                                    Deskripsi :
                                    <br>
                                    {!! $p->produk->deskripsi !!}
                                </div>
                                {{-- <a href="details.html" class="stretched-link"></a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="stories">
        <div class="d-flex flex-row justify-content-center align-items-center container">
            <img src="{{ asset('assets/frontend/images/details-image.png') }}" alt="semina" class="d-none d-lg-block"
                width="515" />
            <div class="d-flex flex-column">
                <div>
                    <div class="sub-title">
                        <span class="text-gradient-pink">Story</span>
                    </div>
                    <div class="title">
                        CV MITRA JAYA MELAYANI <br class="d-none d-lg-block" />
                        {{-- For The Better World. --}}
                    </div>
                </div>
                <p class="paragraph">
                    Cv mitra jaya melayani hampir semua kebutuhan percetakan untuk bisnismu, pelayanan jasa kami pencetakan
                    produk. Pekerjaan kami dilakukan oleh tenaga profesional yang ahli dalam bidang nya
                    <br class="d-none d-lg-block" />
                </p>
                <a href="https://wa.me/{{ $about->wa }}" class="btn-navy" target="_BLANK">HUBUNGI KAMI</a>
            </div>
        </div>
    </section>
@endsection

@push('after-script')
@endpush
