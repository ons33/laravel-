@extends('layouts/contentNavbarLayout')

@section('title', 'Créer un Contrat')

@section('content')

<div class="row">
    <div class="col-md-12 text-center">
        <h2 class="ltext-105 cl0">Créer un Contrat 😊</h2>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-6 d-flex align-items-center">
        <div class="image-container">
            <img src="https://img.freepik.com/premium-vector/job-search-set-recruitment-personnel-management-concept_277904-20582.jpg?w=2000&fbclid=IwAR2LmkN6cuGjQJRLZu-3PIm4pPtXMt6vez3l0n_MVhe5AuKLE1vA1BzKTK8" class="card-img-top" alt="Job Image">
        </div>
    </div>

    <div class="col-md-6">
        <div class="application-form">
            <h3>Informations sur la Candidature</h3>
            <p><strong>Job Title:</strong> {{ $condidature->job_title }}</p>
            <p><strong>Name:</strong> {{ $condidature->name }}</p>
            <p><strong>Email:</strong> {{ $condidature->email }}</p>
            <!-- Add other candidate information fields here -->
            <hr>

            <h3>Ajouter un Contrat</h3>
            <form action="{{ route('add.contract', ['condidature_id' => $condidature->id]) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="type">Type</label>
                    <select id="type" name="type" class="form-control" required>
                        <option value="CDI" {{ old('type') == 'CDI' ? 'selected' : '' }}>CDI</option>
                        <option value="CDD" {{ old('type') == 'CDD' ? 'selected' : '' }}>CDD</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="duree">Durée</label>
                    <input type="text" id="duree" name="duree" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="salaire">Salaire</label>
                    <input type="text" id="salaire" name="salaire" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="date_debut">Date de début</label>
                    <input type="date" id="date_debut" name="date_debut" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="date_fin">Date de fin</label>
                    <input type="date" id="date_fin" name="date_fin" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="etat">État</label>
                    <input type="text" id="etat" name="etat" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <br>
            <br>
        </div>
    </div>
</div>

<!-- Include DataTables CSS and JavaScript -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
</script>

@endsection
