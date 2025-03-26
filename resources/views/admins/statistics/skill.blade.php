<!-- 4段目：スキル件数Top10グラフを横並びで追加 -->
<div class="d-flex justify-content-between" style="gap: 20px;">
    <div class="card" style="width: 48%;">
        <div class="card-body">
            <h4>Project Required Skills Top 10 (Current)</h4>
            <canvas id="projectSkillTop10Chart"></canvas>
        </div>
    </div>
    <div class="card" style="width: 48%;">
        <div class="card-body">
            <h4>Freelancer's Skills Top 10 (Current)</h4>
            <canvas id="freelancerSkillTop10Chart"></canvas>
        </div>
    </div>
</div>

<!-- 5段目：スキルTrendのグラフを縦2段、全幅で表示 -->
<div class="mt-3">
    <div class="card mb-4 w-100">
        <div class="card-body">
            <h4>Project Required Skills Trends</h4>
            <canvas id="projectSkillsChart" class="skill-chart"></canvas>
        </div>
    </div>
    <div class="card w-100">
        <div class="card-body">
            <h4>Freelancer's Skills Trends</h4>
            <canvas id="freelancerSkillsChart" class="skill-chart"></canvas>
        </div>
    </div>
</div>


@push('scripts')
<script>
    const projectSkillTop10DataUrl = "{{ route('admin.statistics.project_skill_top10') }}";
    const freelancerSKillTop10DataUrl = "{{ route('admin.statistics.freelancer_skill_top10') }}";
    const projectSkillTrendDataUrl = "{{ route('admin.statistics.skills') }}";
    const freelancerSKillTrendDataUrl = "{{ route('admin.statistics.freelancer_skills') }}";
</script>
<script src="{{ asset('js/admins/statistics/skill.js') }}"></script>
@endpush