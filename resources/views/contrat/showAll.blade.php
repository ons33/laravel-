@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
</script>

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Job Applicants</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Job Applicants</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable">
                    <thead>
        <tr>
            <th>ID</th>
            <th>Type de contrat</th>
            <th>Durée</th>
            <th>Salaire</th>
            <th>Date Debut</th>
            <th>Date Fin</th>
            <th>Description</th>
            <th>Etat</th>
            <th>Actions</th>

            <!-- Ajoutez d'autres en-têtes si nécessaire -->
        </tr>
    </thead>
    <tbody>
        @foreach($contrats as $contrat)
            <tr>
                <td>{{ $contrat->id }}</td>
                <td>{{ $contrat->type }}</td>
                <td>{{ $contrat->duree }}</td>
                <td>{{ $contrat->salaire }}</td>
                <td>{{ $contrat->date_debut }}</td>
                <td>{{ $contrat->date_fin }}</td>
                <td>{{ $contrat->description }}</td>
                <td>{{ $contrat->etat }}</td>
                <td>
                <form action="{{ route('deletecontract', ['id' => $contrat->id]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contract?');">
                    Delete
                </button>
            </form>
                                </td>
                                <td>
                                    <a href="{{ route('contrat.pdf', $contrat->id) }}" class="btn btn-success">Télécharger PDF</a>
                                </td>
    
</td>

                  
                   
                <!-- Ajoutez d'autres colonnes si nécessaire -->
            </tr>
        @endforeach
    </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
@endsection