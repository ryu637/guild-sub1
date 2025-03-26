<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Freelancer;

class FreelancerController extends Controller
{   
    private $freelancer;

    public function __construct(Freelancer $freelancer_model){
        $this->freelancer = $freelancer_model;
    }
    
    public function getAllFreelancers(Request $request)
    {
        $query = Freelancer::with(['user'])->withTrashed();

        if ($request->filled('freelancer_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('username', 'LIKE', '%' . $request->freelancer_name . '%');
            });
        }

        $all_freelancers = $query->orderBy('id', 'asc')->paginate(4);

        return view('admins.freelancer', compact('all_freelancers'));
    }

    public function showFreelancer($id){
        $user = User::findOrFail($id);
        $freelancer = $user->freelancer;

        if($freelancer){
            if($freelancer->evaluations()){
                $evaluations = $freelancer->evaluations()->get();
            }
            if($freelancer->applications()){
                $ongoingProjects  = $freelancer->applications()
                                                ->where('freelancer_id', $freelancer->id)
                                                ->where('status', '!=', 'completed')
                                                ->get();

                $completedProjects  = $freelancer->applications()
                                                ->where('freelancer_id', $freelancer->id)
                                                ->where('status', 'completed')
                                                ->get();
            }
                $favoriteProjects = $user->favoriteProjects()->get();
        }else{
            $evaluations = collect();
            $ongoingProjects = collect();
            $completedProjects = collect();
            $favoriteProjects = collect();
        }

        return view('admins.freelancer-profile', compact('user', 'evaluations', 'ongoingProjects', 'completedProjects', 'favoriteProjects'));
    }


    public function deactivate($id){
        $freelancer = $this->freelancer->findOrFail($id);
        $freelancer->user()->delete();
        $freelancer->delete();
        return redirect()->route('admin.freelancer');
    }

    public function activate($id){
        $freelancer = $this->freelancer->withTrashed()->findOrFail($id);
        $user = $freelancer->user;
        if ($user && $user->trashed()){
            $user->restore();
        }
        
        $freelancer->restore();
        return redirect()->route('admin.freelancer');
    }
}
