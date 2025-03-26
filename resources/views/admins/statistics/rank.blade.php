<!-- 3段目：プロジェクトのrequired rankとフリーランサーrankの内訳-->
<div class="d-flex justify-content-between" style="gap: 20px;">
    <div class="card" style="width: 48%;">
        <div class="card-body">
            <h4 class="card-title">Project Required Rank</h4>
            <canvas id="projectRanksChart" width="400" height="300"></canvas>
        </div>
    </div>
    <div class="card" style="width: 48%;">
        <div class="card-body">
            <h4 class="card-title">Freelancer's Rank</h4>
            <canvas id="freelancerRanksChart" width="400" height="300"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const projectRankDataUrl = "{{ route('admin.statistics.project_ranks') }}";
    const freelancerRankDataUrl = "{{ route('admin.statistics.freelancer_ranks') }}";
</script>
<script src="{{ asset('js/admins/statistics/rank.js') }}"></script>
@endpush