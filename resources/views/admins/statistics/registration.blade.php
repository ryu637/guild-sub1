<!-- 1段目：登録者数の週間推移 -->
<div class="d-flex justify-content-between" style="width: 100%; gap: 20px;">
    <div class="card" style="width: 48%;">
        <div class="card-body">
            <h4 class="card-title">Weekly Registrations (Company)</h4>
            <canvas id="companyRegistrationsChart" width="400" height="300"></canvas>
        </div>
    </div>
    <div class="card" style="width: 48%;">
        <div class="card-body">
            <h4 class="card-title">Weekly Registrations (Freelancer)</h4>
            <canvas id="freelancerRegistrationsChart" width="400" height="300"></canvas>
        </div>
    </div>    
</div>

<!-- 2段目：新規登録プロジェクト数の週間推移-->
<div class="card mt-4 ms-0" style="width: 48%;">
    <div class="card-body">
        <h4 class="card-title">Number of Projects</h4>
        <canvas id="projectsChart" width="400" height="300"></canvas>
    </div>
</div>

@push('scripts')
<script>
    const statisticsDataUrl = "{{ route('admin.statistics.data') }}";
</script>
<script src="{{ asset('js/admins/statistics/registration.js') }}"></script>
@endpush