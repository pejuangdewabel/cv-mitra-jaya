@extends('frontend.layouts.app-auth')

@section('content')
    <section class="grow-today">
        <div class="container">
            <div class="sub-title mb-1" id="grow-today">
                <span class="text-gradient-pink">SILIHAKAN PILIH PRODUK KAMI</span>
            </div>
            <div class="title">
                Berbagai macam produk percetakan
            </div>
            <div class="mt-5 row gap">
                <!-- CARD 1 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card-grow h-100">
                        <span class="badge-pricing">Rp. 5000</span>
                        <img src="{{ asset('assets/frontend/images/Product/Book.jpg') }}" alt="semina" />
                        <div class="card-content">
                            <div class="card-title">
                                Cetak Buku
                            </div>
                            <div class="card-subtitle">
                                Product Design
                            </div>
                            <div class="description">
                                Terjual 10
                            </div>
                            <a href="details.html" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                <!-- CARD 2 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card-grow h-100">
                        <span class="badge-pricing">Rp. 6000</span>
                        <img src="https://i.pinimg.com/550x/53/39/f3/5339f30eeea09f1b1661c4ea489617a9.jpg" alt="semina" />
                        <div class="card-content">
                            <div class="card-title">
                                Cetak Kalender Meja
                            </div>
                            <div class="card-subtitle">
                                Product Design
                            </div>
                            <div class="description">
                                Terjual 6
                            </div>
                            <a href="details.html" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                <!-- CARD 3 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card-grow h-100">
                        <span class="badge-pricing">Rp. 6000</span>
                        <img src="https://i.pinimg.com/550x/53/39/f3/5339f30eeea09f1b1661c4ea489617a9.jpg" alt="semina" />
                        <div class="card-content">
                            <div class="card-title">
                                Cetak Kalender Meja
                            </div>
                            <div class="card-subtitle">
                                Product Design
                            </div>
                            <div class="description">
                                Terjual 6
                            </div>
                            <a href="details.html" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                <!-- CARD 4 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card-grow h-100">
                        <span class="badge-pricing">Rp. 5000</span>
                        <img src="{{ asset('assets/frontend/images/Product/Book.jpg') }}" alt="semina" />
                        <div class="card-content">
                            <div class="card-title">
                                Cetak Buku
                            </div>
                            <div class="card-subtitle">
                                Product Design
                            </div>
                            <div class="description">
                                Terjual 10
                            </div>
                            <a href="details.html" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
