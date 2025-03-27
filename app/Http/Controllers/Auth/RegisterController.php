<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Freelancer;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';


    public function __construct(){
        $this->middleware('guest');
    }


    public function registered($request, $user){

        if ($user->role_id == 2) {
            return redirect()->route('company.project.on_going');
        }

        if ($user->role_id == 3) {
            return redirect()->route('freelancer.index');
        }

        return redirect('/home');
    }




    protected function validator(array $data)
    {
        $rules = [
            'role_id' => ['required', 'in:2,3'], // Role must be either company (2) or freelancer (3)
        ];
        // Add validation rules based on role_id
        if ($data['role_id'] == '2') { // For companies
            $rules = array_merge($rules, [
                'company_name' => ['required', 'string', 'max:255'],
                'company_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'company_password' => ['required', 'string', 'min:8', 'confirmed'],
                'avatar'        => ['nullable','mimes:jpeg,jpg,png,gif','max:1048'],
                'address'       => ['nullable','string','max:255'],
                'website'       => ['nullable','string','max:255'],
                'paypal_account'   => ['nullable','string','max:255'],
                'representative'       => ['nullable','string','max:255'],
                'employee'       => ['nullable','integer'],
                'capital'       => ['nullable','numeric'],
                'annualsales'       => ['nullable','numeric'],
                'description'  => ['nullable','string','max:255']
            ]);
        } elseif ($data['role_id'] == '3') { // For freelancers
            $rules = array_merge($rules, [
                'username' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'avatar'     => ['mimes:jpeg,jpg,png,gif', 'max:1048'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'github_id'  => ['nullable', 'string', 'max:255'],
                'x'          => ['nullable', 'string', 'max:255'],
                'instagram'  => ['nullable', 'string', 'max:255'],
                'facebook'   => ['nullable', 'string', 'max:255']
            ]);
        }
        return Validator::make($data, $rules);
    }




    protected function create(array $data)
    {
        // Create the user based on the role_id
        if ($data['role_id'] == '2') {
            // Company registration
            $user =  User::create([
                'username' => $data['company_name'],
                'name' => $data['company_name'], // Consider renaming 'name' to 'company_name' in the User model
                'email' => $data['company_email'],
                'password' => Hash::make($data['company_password']),
                'role_id' => $data['role_id'],
            ]);

            Company::create([
                'user_id' => $user->id,
                'address' => null,
                'website' => null,
                'total_spent' => 0.00,
                'representative'       => null,
                'employee'       => null,
                'capital'       => null,
                'annualsales'       => null,
                'description'  => null
            ]);

            return $user;
        }

        if ($data['role_id'] == '3') {
            // Freelancer registration
            $user = User::create([
                'username' => $data['username'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => $data['role_id'],
            ]);

            Freelancer::create([
                'user_id' => $user->id,
                'rank' => 1,
                'rank_point' => 0,
                'github' => null,
                'X' => null,
                'instagram' => null,
                'facebook' =>  null,
                'total_earnings' => 0
            ]);


            return $user;
        }
    }
}

