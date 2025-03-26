@extends('layouts.freelancer')

@section('title', 'Edit Profile')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/users/profile.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/selected-language.js')}}"></script>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        <a href="{{url()->previous()}}" class="fs-2  back-link"><i class="fa-solid fa-hand-point-left me-2"></i>Go Back</a>

        <div class="border border-black rounded shadow py-5 px-5 my-3">
            {{-- 成功メッセージ表示 --}}
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

            <form action="{{route('freelancer.profile.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <h3 class="mb-4 fw-bold">Edit Profile</h3>
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control mb-4" value="{{$user->username}}">

                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control mb-4" value="{{$user->name}}">


                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control mb-4  w-50" value="{{$user->email}}">

                <label for="github-id" class="form-label">Github ID</label>
                <input type="text" name="github" class="form-control mb-4 w-50" value="{{$user->freelancer->github}}">
                <label for="X" class="form-label">X</label>
                <input type="text" name="x" class="form-control mb-4 w-50" value="{{$user->freelancer->X}}">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="text" name="instagram" class="form-control mb-4 w-50" value="{{$user->freelancer->instagram}}">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="text" name="facebook" class="form-control mb-4 w-50" value="{{$user->freelancer->facebook}}">

                <div class="select-container">
                    <label for="select-skill" class="form-label">Select your skills</label>
                    <div class="custom-select" onclick="toggleDropdown()">
                        <span>Select Language</span>
                        <span>&#9660;</span>
                    </div>
                    <div class="dropdown">
                        <div data-value="" selected hidden>Please select skill</div>
                        @foreach ($skills as $skill)
                            <div data-value="{{$skill->id}}">{{$skill->name}}</div>
                        @endforeach
                    </div>
                </div>

                <div class="selected-tags mb-4">
                    @foreach ($user->freelancer->skills as $skill)
                        <div class="tag selected-option" data-value="{{$skill->id}}">
                            {{$skill->name}}
                            <span onclick="removeTag(this)">x</span>
                        </div>
                    @endforeach
                </div>

                <label for="avatar" class="form-label">Avatar</label>
                <input type="file" name="avatar" class="form-control mb-4 w-50">

                <button type="submit" class="btn btn-dark w-100 mt-4">Update</button>

            </form>
        </div>

    </div>
</div>
@endsection
