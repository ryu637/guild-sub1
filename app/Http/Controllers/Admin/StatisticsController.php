<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        return view('admins.statistics.index');
    }

    public function getStatisticsData()
{
    $weeks = [];
    $freelancerCounts = [];
    $companyCounts = [];
    $projectCounts = [];

    // 過去6週間分のデータを取得
    for ($i = 5; $i >= 0; $i--) {
        $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
        $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();

        $weeks[] = $startOfWeek->format('Y-m-d') . ' ~ ' . $endOfWeek->format('Y-m-d');

        // フリーランサー (role_id = 3)
        $freelancerCounts[] = User::where('role_id', 3)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        // カンパニー (role_id = 2)
        $companyCounts[] = User::where('role_id', 2)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        // プロジェクト数
        $projectCounts[] = Project::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
    }

    return response()->json([
        'weeks'            => $weeks,
        'freelancerCounts' => $freelancerCounts,
        'companyCounts'    => $companyCounts,
        'projectCounts'    => $projectCounts
    ]);
}

        

    public function getProjectSkillStatistics()
    {
        $weeks = [];
        $skills = DB::table('skills')->get();
        $skillData = [];

        for ($i = 5; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            $weeks[] = $startOfWeek->format('Y-m-d') . ' ~ ' . $endOfWeek->format('Y-m-d');
        }

        foreach ($skills as $skill) {
            $weeklyCounts = [];

            for ($i = 5; $i >= 0; $i--) {
                $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
                $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();

                $count = DB::table('project_skills')  // ← ここは project_skills を参照
                    ->where('skill_id', $skill->id)
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                    ->count();

                $weeklyCounts[] = $count;
            }

            $skillData[] = [
                'name' => $skill->name,
                'weekly_counts' => $weeklyCounts
            ];
        }

        return response()->json([
            'weeks' => $weeks,
            'skills' => $skillData
        ]);
    }

    public function getFreelancerSkillStatistics()
    {
        $weeks = [];
        $skills = DB::table('skills')->get();
        $skillData = [];

        for ($i = 5; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            $weeks[] = $startOfWeek->format('Y-m-d') . ' ~ ' . $endOfWeek->format('Y-m-d');
        }

        foreach ($skills as $skill) {
            $weeklyCounts = [];

            for ($i = 5; $i >= 0; $i--) {
                $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
                $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();

                $count = DB::table('freelancer_skills')  // ✅ ここで freelancer_skills テーブルを参照
                    ->where('skill_id', $skill->id)
                    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                    ->count();

                $weeklyCounts[] = $count;
            }

            $skillData[] = [
                'name' => $skill->name,
                'weekly_counts' => $weeklyCounts
            ];
        }

        return response()->json([
            'weeks' => $weeks,
            'skills' => $skillData
        ]);
    }

    // プロジェクトスキル件数Top10
    public function getProjectSkillTop10()
    {
        $topSkills = DB::table('project_skills')
            ->select('skills.name', DB::raw('COUNT(*) as count'))
            ->join('skills', 'project_skills.skill_id', '=', 'skills.id')
            ->groupBy('skills.name')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        return response()->json($topSkills);
    }

    // フリーランサースキル件数Top10
    public function getFreelancerSkillTop10()
    {
        $topSkills = DB::table('freelancer_skills')
            ->select('skills.name', DB::raw('COUNT(*) as count'))
            ->join('skills', 'freelancer_skills.skill_id', '=', 'skills.id')
            ->groupBy('skills.name')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        return response()->json($topSkills);
    }

    public function projectRanks()
    {
        $ranks = \DB::table('projects')
            ->select('required_rank', \DB::raw('count(*) as count'))
            ->groupBy('required_rank')
            ->orderBy('required_rank')
            ->pluck('count', 'required_rank');

        // rank1〜5 まで0件の場合も補完
        $result = [];
        for ($i = 1; $i <= 5; $i++) {
            $result[] = $ranks[$i] ?? 0;
        }

        return response()->json(['counts' => $result]);
    }

    public function freelancerRanks()
    {
        $ranks = \DB::table('freelancers')
            ->select('rank', \DB::raw('count(*) as count'))
            ->groupBy('rank')
            ->orderBy('rank')
            ->pluck('count', 'rank');

        // rank1〜5 まで0件の場合も補完
        $result = [];
        for ($i = 1; $i <= 5; $i++) {
            $result[] = $ranks[$i] ?? 0;
        }

        return response()->json(['counts' => $result]);
    }
}