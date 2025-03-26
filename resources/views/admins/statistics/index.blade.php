@extends('admins.dashboard')

@section('title', 'Admin: Statistics')

@section('page-content')
<main class="pt-1">
    <div class="container ms-5">
        <div class="card border-secondary mb-4">
            <div class="card-header custom-light-gray">
                <h2 class="h4 m-0">Statistics Overview</h2>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills my-3" id="statisticsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active btn btn-outline-secondary" id="weekly-tab" data-bs-toggle="tab" data-bs-target="#weekly" type="button" role="tab">
                            Registrations
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link btn btn-outline-secondary" id="rank-tab" data-bs-toggle="tab" data-bs-target="#rank" type="button" role="tab">
                            Rank
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link btn btn-outline-secondary" id="skill-tab" data-bs-toggle="tab" data-bs-target="#skill" type="button" role="tab">
                            Skills
                        </button>
                    </li>
                </ul>

                <div class="tab-content mt-4" id="statisticsTabContent">
                    <div class="tab-pane fade show active" id="weekly" role="tabpanel">
                        @include('admins.statistics.registration')
                    </div>
                    <div class="tab-pane fade" id="rank" role="tabpanel">
                        @include('admins.statistics.rank')
                    </div>
                    <div class="tab-pane fade" id="skill" role="tabpanel">
                        @include('admins.statistics.skill')
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
@endpush
