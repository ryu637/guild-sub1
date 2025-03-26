@extends('admins.dashboard')

@section('title', 'Admin: Company')

@section('page-content')
<div class="container ms-5">
    <div class="card border-secondary mb-4">
        <div class="card-header custom-light-gray">
            <h2 class="h4 m-0">Companies List</h2>
        </div>
        <div class="card-body">

            <!-- 検索フォーム -->
            <div class="mb-2">
                <h5 class="m-0">🔎 Search Companies</h5>
            </div>
            <form method="GET" action="{{ route('admin.company') }}" class="row mb-4 g-3">
                <div class="col-md-6">
                    <input type="text" name="company_name" class="form-control border-dark" placeholder="Search by Company Name" value="{{ request('company_name') }}">
                </div>
                <div class="col-md-6 d-flex">
                    <button type="submit" class="btn btn-secondary me-2">Search</button>
                    <a href="{{ route('admin.company') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

            @foreach ($all_companies as $company)
            <div class="col-12 card my-3 shadow-sm">  <!-- ✅ col-12 を追加してfreelancerと同じ -->
                <table class="table table-sm table-borderless align-middle text-secondary my-2">  <!-- ✅ table-smを追加 -->
                    <tr>
                        <td></td>
                        <td rowspan="4" class="mx-5">  <!-- ✅ freelancerと同様 mx-5 に -->
                            @if ($company->user->avatar)
                                <img src="{{ $company->user->avatar }}" alt="Avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <i class="fa-solid fa-circle-user icon-lg"></i>
                            @endif
                        </td>
                        <td style="width: 25%;">Company Name:</td>  <!-- ✅ 幅をfreelancerの"Freelancer Name"と同じ25%に -->
                        <td style="width: 35%;">
                            @if ($company->trashed())
                                {{ $company->user->username }}
                            @else
                            <a href="{{ route('company.profile.profile',$company->user->id) }}" class="text-decoration-none text-dark">
                                {{ $company->user->username }} </a>
                            @endif
                        </td>
                        <td>
                            @if ($company->trashed())
                                <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive
                            @else
                                <i class="fa-solid fa-circle text-primary"></i>&nbsp; Active
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if ($company->trashed())
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $company->user->id }}">
                                            <i class="fa-solid fa-user-check"></i> Activate {{ $company->user->name }}
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $company->user->id }}">
                                            <i class="fa-solid fa-user-slash"></i> Deactivate {{ $company->user->name }}
                                        </button>
                                    @endif                                    
                                </div>
                            </div>
                            @include('admins.modal.company') 
                        </td>    
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 100px;">Email:</td>   <!-- ✅ Email 行もfreelancerと同じ100pxに -->
                        <td style="width: 200px;">{{ $company->user->email }}</td>  <!-- ✅ 幅200px に統一 -->
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 100px;">Website:</td>  <!-- ✅ Website行も同様 -->
                        <td style="width: 200px;">{{ $company->website }}</td>
                        <td></td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $all_companies->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
