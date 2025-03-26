@extends('admins.dashboard')

@section('title', 'Admin: Project')

@section('page-content')
<div class="container ms-5">
    <div class="card border-secondary mb-4">
        <div class="card-header custom-light-gray">
            <h2 class="h4 m-0">Projects List</h2>
        </div>
        <div class="card-body">
            
            <!-- 検索フォーム -->
            <div class="mb-2">
                <h5 class="m-0">🔎 Search Projects</h5>
            </div>
            <form method="GET" action="{{ route('admin.project') }}" class="row mb-4 g-3">
                <div class="col-md-4">
                    <input type="text" name="project_title" class="form-control border-dark" placeholder="Search by Project Title" value="{{ request('project_title') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="company_name" class="form-control border-dark" placeholder="Search by Company Name" value="{{ request('company_name') }}">
                </div>
                <div class="col-md-4 d-flex">
                    <button type="submit" class="btn  btn-secondary me-2">Search</button>
                    <a href="{{ route('admin.project') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
            
            @foreach ($all_projects as $project)
            <div class="card my-3 shadow-sm">
                <table class="table table-borderless align-middle text-secondary my-2" style="line-height: 1;">
                    <tr>
                        <td style="width: 20px"></td>
                        <td rowspan="3" style="width: 100px;" class="bg-secondary text-white text-center fw-bold">
                            {{ \Carbon\Carbon::parse($project->deadline)->format('n/j') }}
                        </td>
                        <td colspan="2" class="ps-4">
                            <a href="{{ route('company.project.detail', $project->id) }}" class="text-decoration-none text-dark" title="{{ $project->title }}">
                                {{ \Str::limit($project->title, 60) }} 
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20px"></td>
                        <td colspan="2" class="ps-4">
                            <a href="{{ route('company.profile.profile', $project->company->user->id) }}" class="text-decoration-none text-dark">
                                {{ $project->company->user->username }}
                            </a>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="width: 20px"></td>
                        <td class="ps-4">
                            ${{ number_format($project->reward_amount, 2) }}
                            <span class="ps-3">
                                @for ($i = 1; $i <= $project->required_rank; $i++)
                                    <i class="fa-solid fa-star text-warning"></i>
                                @endfor
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $all_projects->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
