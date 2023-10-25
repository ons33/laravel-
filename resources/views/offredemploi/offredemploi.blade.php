@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Tables /</span> Basic Tables
    </h4>
    <div class="mb-3">
        <a href="{{ route('offre.create') }}" class="btn btn-success">Add</a>
    </div>
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Table Basic</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>titre</th>
                        <th>Societe</th>
                        <th>emplacement</th>
                        <th>Type</th>
                        <th>apropos</th>
                        <th>salaire</th>
                        <th>candidature</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($offres as $offre)
                        <tr>
                            <td>{{ $offre->id }}</td>
                            <td><strong>{{ $offre->titre }}</strong></td>
                            <td>{{ $offre->societe->name }}</td> <!-- Use the societe relationship to get the name -->
                            <td>{{ $offre->emplacement }}</td>
                            <td><span class="badge bg-label-primary me-1">{{ $offre->Type }}</span></td>
                            <td>{{ $offre->apropos }}</td>
                            <td>{{ $offre->salaire }}</td>
                            <td>{{ $offre->candidature_count }}</td>
                            <td>
                                <div>
                                    <a class="btn btn-primary"
                                        href="{{ route('offre.candidatures', ['id' => $offre->id]) }}">
                                        <i class="bx bx-show me-1"></i> View Candidatures
                                    </a>

                                    <form action="{{ route('deleteoffre', ['id' => $offre->id]) }} " method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"><i class="bx bx-trash me-1"></i></button>
                                    </form>
                                    <a class="btn btn-primary" href="{{ route('offre.edit', ['id' => $offre->id]) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Center-align the pagination -->
            <div class="d-flex justify-content-center">
                {{ $offres->links() }}
            </div>
        </div>
    </div>
@endsection
