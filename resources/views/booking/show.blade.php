@extends('bagianAwal.main')

@section('title', 'Booking - ' . $data['title'])

@section('content')
<div class="container my-5">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <div class="row g-4 align-items-start">
            <aside class="col-md-5">
                <div class="overflow-hidden rounded-3 shadow-sm">
                    <img src="{{ asset($data['image']) }}" class="img-fluid" alt="{{ $data['title'] }}">
                </div>
            </aside>

            <section class="col-md-7">
                <h2 class="mb-2" style="color: #00aaff;">{{ $data['title'] }}</h2>
                <h5 class="text-muted">Detail Paket</h5>

                <div class="package-description mt-3 text-secondary">
                    {{-- description contains safe HTML (ul/li) set in controller --}}
                    {!! $data['description'] !!}
                </div>

                <p class="mt-3 mb-4"><strong>Harga:</strong> <span class="text-primary">{{ $data['price'] }}</span></p>

                <form method="POST" action="{{ route('booking.store') }}" class="booking-form">
                    @csrf
                    <input type="hidden" name="package_name" value="{{ $data['title'] }}">

                    <div class="mb-3">
                        <label for="booking_date" class="form-label small text-muted">Pilih Tanggal Pemotretan</label>
                        <input type="date" id="booking_date" name="booking_date" class="form-control rounded-pill" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill">Konfirmasi Booking</button>
                </form>
            </section>
        </div>
    </div>
</div>

<style>
    .package-description ul { padding-left: 1.2rem; }
    .package-description li { margin-bottom: 0.4rem; }
    .booking-form .form-control { padding: 10px 14px; }
    .btn-primary { background-color: #00aaff; border-color: #00aaff; }
    .btn-primary:hover { background-color: #0088cc; border-color: #0088cc; }
    @media (max-width: 767px) {
        .booking-form { margin-top: 1rem; }
    }
</style>
@endsection
