@extends('layouts/contentNavbarLayout')

@section('title', 'Cards basic - UI elements')

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
<div class="row mb-5">
    @foreach($offres as $offre)
    <div class="col-md-4 mb-3">
        <div class="card">
            <img  style="height:200px" src="{{ url('https://img.freepik.com/vecteurs-libre/petites-personnes-recherche-opportunites-commerciales_74855-19928.jpg') }}" class="card-img-top" alt="Job Image">
            <div class="card-header">
              <span class="badge rounded-pill bg-label-info"> {{ $offre->Type }}</span>
            </div>
            <div class="card-body">
                <h4 class="card-title">{{ $offre->titre }}</h4>
                <p class="card-text">
                    {{ $offre->apropos }}
                </p>
                <h6><i class="bx bx-map"></i> {{ $offre->emplacement }}</h6> <!-- Use the appropriate icon for place -->
                <h6><i class="bx bx-dollar"></i> {{ $offre->salaire }}</h6>

                <!-- Create a row and a column for the button -->
                <div class="row">
                    <div class="col">
                        <!-- Use the full width of the card for the button -->
                        <div class="text-center">
                            
                        <a href="{{ route('creatportfolio', ['id' => $offre->id]) }}" class="btn btn-primary btn-block">Apply now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!--/ Card layout -->
@endsection
