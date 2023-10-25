@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>

    <div class="page-wrapper">
        <div class="content container-fluid">
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
            <div class="row">
                <div class="col-md-12">
                <div class="table-responsive">
    <table class="table table-striped custom-table mb-0 datatable">
        <thead>
            <tr>
                <th>No</th>
              
                <th>Job</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Apply Date</th>
                <th>Status</th>
                <th>Resume</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($condidatures as $key=>$apply )
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $apply->offreEmploi->titre }}</td>
                <td>{{ $apply->name }}</td>
                <td>{{ $apply->email }}</td>
                <td>{{ $apply->phone }}</td>
                <td>{{ date('d F, Y', strtotime($apply->created_at)) }}</td>
                <td>{{ $apply->status }}</td>
                <td>
                    <a href="{{ route('download.cv', ['id' => $apply->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-download"></i> Download CV
                    </a>
                </td>

 
                <td>
                    <form action="{{ route('deletecondidature', ['id' => $apply->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
                            <i class="bx bx-trash"></i> Delete
                        </button>
                    </form>

                    <button class="btn btn-sm btn-info" onclick="showModal('{{ $apply->id }}')">
                        <i class="bx bx-edit"></i> Update
                    </button>
                   
                    <a href="{{ route('creatcontrat', ['id' => $apply->id]) }}" class="btn btn-primary">
                        Add Contrat
                    </a>


                </td>

           
                                    <!-- Modèle pour la pop-up -->
                                    <div class="modal fade" id="editModal{{ $apply->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $apply->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $apply->id }}">Edit Condidature</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulaire pour la mise à jour -->
                                                    <form action="{{ route('condidatur.update', ['id' => $apply->id]) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label>Job Title</label>
                                                            <input class="form-control @error('job_title') is-invalid @enderror" type="text" name="job_title" value="{{ $apply->job_title }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $apply->name }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input class="form-control @error('phone') is-invalid @enderror" type="tel" name="phone" value="{{ $apply->phone }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Email Address</label>
                                                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ $apply->email }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Message</label>
                                                            <textarea class="form-control @error('message') is-invalid @enderror" name="message">{{ $apply->message }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                                                        <label>Upload your CV</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input @error('cv_upload') is-invalid @enderror" id="cv_upload" name="cv_upload">
                                                                <label class="custom-file-label" for="cv_upload">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                                <option value="Nouveau" {{ $apply->status == 'Nouveau' ? 'selected' : '' }}>Nouveau</option>
                                                                <option value="Annulé" {{ $apply->status == 'Annulé' ? 'selected' : '' }}>Annulé</option>
                                                                <option value="En cours" {{ $apply->status == 'En cours' ? 'selected' : '' }}>En cours</option>
                                                                <option value="accepte" {{ $apply->status == 'accepte' ? 'selected' : '' }}>Accepte</option>
                                                            </select>
                                                        </div>


                                                        <!-- Ajoutez d'autres champs de formulaire au besoin -->

                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function showModal(id) {
        $('#editModal' + id).modal('show');
    }
</script>
