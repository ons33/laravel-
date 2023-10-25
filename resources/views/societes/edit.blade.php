@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Societe')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Edit Societe</span>
    </h4>

    <form action="{{ route('societes.update', $societe->id) }}" method="POST">


        @csrf
        @method('PUT') <!-- Use PUT method for updating -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $societe->name }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" value="{{ $societe->address }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ $societe->phone_number }}"
                class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ $societe->email }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Societe</button>
    </form>
@endsection
