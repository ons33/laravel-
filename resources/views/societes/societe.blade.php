@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Tables /</span> Basic Tables
    </h4>
    <div class="mb-3">
    </div>
    <!-- Basic Bootstrap Table -->
    <div class="card">

        <h5 class="card-header">Table Basic</h5>
        <a href="{{ route('societes.create') }}" class="btn btn-primary">Add Societe</a>

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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($societes as $societe)
                        <tr>
                            <td>{{ $societe->id }}</td>
                            <td><strong>{{ $societe->name }}</strong></td>
                            <td>{{ $societe->address }}</td>
                            <td>{{ $societe->phone_number }}</td>
                            <td>{{ $societe->email }}</td>
                            <td>{{ $societe->salaire }}</td>
                            <td>
                                <div>
                                    <form action="{{ route('destroyy', $societe->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <a href="{{ route('societes.edit', $societe->id) }}" class="btn btn-primary">Update
                                        Societe</a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Center-align the pagination -->
            <div class="d-flex justify-content-center">
                {{ $societes->links() }}
            </div>
        </div>
    </div>
@endsection
