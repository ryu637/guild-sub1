<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Project;


class ProjectController extends Controller
{   
    public function getAllProjects(Request $request)
{
    $query = Project::with(['company' => function ($query) {
            $query->withTrashed(); 
        }])
        ->withTrashed()
        ->orderBy('id', 'asc');

    // プロジェクトタイトル検索
    if ($request->filled('project_title')) {
        $query->where('title', 'like', '%' . $request->project_title . '%');
    }

    // 会社名検索
    if ($request->filled('company_name')) {
        $query->whereHas('company.user', function ($q) use ($request) {
            $q->where('username', 'like', '%' . $request->company_name . '%');
        });
    }

    // ページネーション（4件ずつ） & クエリ引き継ぎ
    $all_projects = $query->paginate(4)->withQueryString();

    return view('admins.project')->with('all_projects', $all_projects);
}

}