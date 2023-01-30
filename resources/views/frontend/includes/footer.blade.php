<footer class="footer bg-navy" id="hubungi">
    <div class="container">
        <a href="index.html">
            <img src="{{ asset('assets/frontend/images/Logo-new/plotter.png') }}" alt="semina" />
            CV MITRA JAYA
        </a>
        <div class="mt-3 d-flex flex-row flex-wrap footer-content align-items-baseline">
            <p class="paragraph">
                Alamat <br class="d-md-block d-none" />
                {{ $about->alamat }}
                <br class="d-md-block d-none" />
                <br class="d-md-block d-none" />
                Jam Operasional :
                <br class="d-md-block d-none" />
                09.00 - 17.00 WIB (Senin - Sabtu)
            </p>
            <div class="d-flex flex-column footer-links">
                <div class="title-links mb-3">Hubungi Kami</div>
                <a href="https://wa.me/{{ $about->wa }}" target="_BLANK">Whatsapp</a>
                <a href="mailto:{{ $about->email }}">Email</a>
                <a href="{{ $about->ig }}">Instagram</a>
                <a href="{{ $about->fb }}">Facebook</a>
            </div>
            <div class="d-flex flex-column footer-links">
                <div class="title-links mb-3">Metode Pembayaran</div>
                @foreach ($metodePembayaran as $mP)
                    <img src="{{ Storage::url($mP->icon) }}" alt="" style="max-width: 40px !important;"
                        title="{{ $mP->nama_pembayaran }}">
                    <br>
                @endforeach
                {{-- <a href="#">
                    <img src="{{ asset('assets/frontend/images/Product/Gopay.png') }}" alt=""
                        style="max-width: 40px !important;">
                    Gopay
                </a>
                <a href="#">
                    <img src="{{ asset('assets/frontend/images/Product/Dana.png') }}" alt=""
                        style="max-width: 40px !important;">
                    Dana --}}
                </a>
            </div>
        </div>
        <div class="d-flex justify-content-center paragraph all-rights">
            <span id="dateNow"></span>
        </div>
    </div>
</footer>
