@extends('layouts/contentNavbarLayout')

@section('title', 'Horizontal Layouts - Forms')

@section('content')
    <h4 class="fw-bold py-3 mb-4">Ajouter offre</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">

        <!-- Basic with Icons -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('offre.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Titre</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" placeholder="titre" name="titre" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Societe</label>
                            <div class="col-sm-10">
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                                    class="bx bx-buildings"></i></span>
                                            <select name="societe_id" class="form-control">
                                                @foreach ($societes as $societe)
                                                    <option value="{{ $societe->id }}">{{ $societe->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Emplacement</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-map-pin"></i></span>
                                        <input type="text" name="emplacement" class="form-control"
                                            placeholder="Emplacement" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Type</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="bx bx-briefcase"></i></span>
                                        <input type="text" name="Type" class="form-control" placeholder="Type" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-message">Apropos</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bx bx-comment"></i></span>
                                        <textarea name="apropos" class="form-control" placeholder="Apropos"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Salaire</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-dollar"></i></span>
                                        <input type="number" name="salaire" class="form-control" placeholder="Salaire" />
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Ajouter Offre</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
