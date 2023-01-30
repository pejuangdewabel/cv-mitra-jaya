@extends('frontend.layouts.app-home', ['about', 'metodePembayaran'])
@push('after-link')
@endpush

@section('content')
    <div class="preview-image bg-navy text-center">
        <img src="{{ Storage::url($data->foto) }}" class="img-content" alt="semina">
    </div>

    <div class="details-content container">
        <div class="d-flex flex-wrap justify-content-lg-center gap">
            <!-- Left Side Description -->
            <div class="d-flex flex-column description">
                <div class="headline">
                    Start Your Design Career With Design Sprint
                </div>
                <div class="event-details">
                    <h6>Event Details</h6>
                    <p class="details-paragraph">
                        Most realtors and investors are using Social Media (Facebook and Google)
                        <b>ineffectively because</b> they don't know what they're doing or to start.
                        They spend hours and hours trying different things and getting nowhere.
                        This makes them feel like giving up on marketing altogether.
                    </p>
                    <p class="details-paragraph">
                        We are a group of professionals who have decided to help people making
                        travel experiences <b>whenever they want</b> and wherever they are.
                        Our virtual tours have as their topic the beauties of the ancient world,
                        such as Ancient Egypt or Ancient Rome, Art and History.
                    </p>
                </div>
                <div class="keypoints">
                    <!-- Key 1 -->
                    <div class="d-flex align-items-start gap-3">
                        <img src="assets/icons/ic-check.svg" alt="semina">
                        <span>Hours trying different things and getting nowhere makes them feel like giving up on
                            marketing altogether.
                        </span>
                    </div>
                    <!-- Key 2 -->
                    <div class="d-flex align-items-start gap-3">
                        <img src="assets/icons/ic-check.svg" alt="semina">
                        <span>Hours trying different things and getting nowhere makes them feel like giving up on
                            marketing altogether.
                        </span>
                    </div>
                    <!-- Key 3 -->
                    <div class="d-flex align-items-start gap-3">
                        <img src="assets/icons/ic-check.svg" alt="semina">
                        <span>Hours trying different things and getting nowhere makes them feel like giving up on
                            marketing altogether.
                        </span>
                    </div>
                </div>
                <div class="map-location">
                    <h6>Event Location</h6>
                    <div class="map-placeholder">
                        <div class="maps">
                            <img src="assets/images/maps.png" alt="">
                            <div class="absolute d-flex justify-content-center align-items-center" id="hoverMe">
                                <a href="#" class="btn-navy" id="btn-maps">
                                    View in Google Maps
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Event -->
            <div class="d-flex flex-column card-event">
                <!-- Speaker Information -->
                <h6>Your Speaker</h6>
                <div class="d-flex align-items-center gap-3 mt-3">
                    <img src="assets/images/avatar.png" alt="semina" width="60">
                    <div>
                        <div class="speaker-name">
                            Shayna Putri
                        </div>
                        <span class="occupation">Designer</span>
                    </div>
                </div>
                <hr>
                <!-- Ticket Information -->
                <h6>Get Ticket</h6>
                <div class="price my-3">$2,980<span>/person</span></div>
                <div class="d-flex gap-3 align-items-center card-details">
                    <img src="assets/icons/ic-marker.svg" alt="semina"> Gowork, Bandung
                </div>
                <div class="d-flex gap-3 align-items-center card-details">
                    <img src="assets/icons/ic-time.svg" alt="semina"> 15.00 PM WIB
                </div>
                <div class="d-flex gap-3 align-items-center card-details">
                    <img src="assets/icons/ic-calendar.svg" alt="semina"> 22 Agustus 2022
                </div>
                <a href="checkout.html" class="btn-green">Join Now</a>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
@endpush
