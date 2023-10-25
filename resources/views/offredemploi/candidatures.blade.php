@extends('layouts/contentNavbarLayout')

@section('title', 'Candidatures for Offre')

@section('content')
    <h4 class="fw-bold py-3 mb-4">Candidatures for offre "{{ $offre->titre }}"</h4>

    <div class="row">
        @if ($candidatures->count() > 0)
            @foreach ($candidatures as $candidature)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $candidature->job_title }}</h5>
                            <p class="card-text">Name: {{ $candidature->name }}</p>
                            <p class="card-text">Email: {{ $candidature->email }}</p>
                            <p class="card-text">Phone: {{ $candidature->phone }}</p>
                            <p class="card-text">Message: {{ $candidature->message }}</p>
                            <p class="card-text">Status: {{ $candidature->status }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <div class="alert alert-info">
                    No candidatures found for this Offre.
                </div>
            </div>
        @endif
    </div>
@endsection
