@extends('layouts.company')

@section('title', 'Edit Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-6 border border-black rounded shadow py-5 px-5">
        @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            {{-- エラー表示 --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form action="{{ route('company.profile.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <h3 class="mb-4 fw-bold">Edit Profile</h3>
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" name="company_name" class="form-control mb-4" value="{{ $user->username }}">

            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control mb-4" value="{{ $user->email }}">

            <label for="website" class="form-label">Website</label>
            <input type="url" name="website" class="form-control mb-4" value="{{ $user->company->website }}">

            <div class="row mb-4">
                <div class="col-md-8">
                    <label for="representative" class="form-label">Representative</label>
                    <input type="text" name="representative" class="form-control" value="{{ $user->company->representative }}">
                </div>
                <div class="col-md-4">
                    <label for="employee" class="form-label">Number of Employee</label>
                    <input type="number" name="employee" class="form-control" value="{{ $user->company->employee }}">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="capital" class="form-label">Capital ($)</label>
                    <input type="number" name="capital" class="form-control" value="{{ $user->company->capital }}">
                </div>
                <div class="col-md-6">
                    <label for="annualsales" class="form-label">Annual Sales ($)</label>
                    <input type="number" name="annualsales" class="form-control" value="{{ $user->company->annualsales }}">
                </div>
            </div>

            <label for="address" class="form-label">Address(Prefecture)</label>
            <input type="text" name="address" class="form-control mb-4 w-50" value="{{ $user->company->address }}">

            <label for="description" class="form-label">Business Description</label>
            <textarea name="description" id="description" cols="30" rows="3" class="form-control mb-4">{{ $user->company->description }}</textarea>

            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" name="avatar" class="form-control mb-4 w-50">

            <button type="submit" class="btn btn-dark w-100 mt-4">Update</button>

        </form>
    </div>
</div>
@endsection
