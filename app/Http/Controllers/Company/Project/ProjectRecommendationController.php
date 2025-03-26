<?php

namespace App\Http\Controllers\Company\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Freelancer;

class ProjectRecommendationController extends Controller
{
    //プロジェクトに対するフリーランサーのおすすめ
    public function recommendedFreelancers($projectId)
{
    // プロジェクトのスキルを取得
    $project = Project::with('skills')->findOrFail($projectId);
    $rank = $project->required_rank;

    // プロジェクトのスキルIDを取得
    $skillIds = $project->skills->pluck('id');

    // プロジェクトのスキルと一致するフリーランサーを取得
    $freelancers = Freelancer::whereHas('skills', function ($query) use ($skillIds, $rank) {
        $query->whereIn('skills.id', $skillIds)
              ->Where('rank', '<', $rank); // orWhere は `skills` テーブルの rank に適用
    })->get();


    return view('companies.projects.recommended_freelancers', compact('freelancers', 'project'));
}
}
