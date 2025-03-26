<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Company;

class CompanyController extends Controller
{   
    private $company;

    public function __construct(Company $company_model){
        $this->company = $company_model;
    }

    public function getAllCompanies(Request $request)
    {
        $query = Company::with(['user'])->withTrashed();

        if ($request->filled('company_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('username', 'LIKE', '%' . $request->company_name . '%');
            });
        }

        $all_companies = $query->orderBy('id', 'asc')->paginate(4);

        return view('admins.company', compact('all_companies'));
    }

    public function showCompany($id){
        $company = Company::with('projects')->findOrFail($id);
        $projects = $company->projects;
        $user = $company->user;
        
        $transactions = Transaction::where('payer_id', $user->id)
                    ->orWhere('payee_id', $user->id)
                    ->with('project')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admins.company-profile', compact('company','user','projects','transactions'));
    }

    public function deactivateCompany($id){
        $company = $this->company->findOrFail($id);
        $company->user()->delete();
        $company->delete();
        return redirect()->route('admin.company');
    }

    public function activateCompany($id){
        $company = $this->company->withTrashed()->findOrFail($id);
        $user = $company->user;
        if ($user && $user->trashed()){
            $user->restore();
        }
        
        $company->restore();
        return redirect()->route('admin.company');
    }
}