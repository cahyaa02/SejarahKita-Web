<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\LogApps;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'username' => ['required' , 'string', 'min:4'],
        //     'name' => ['required', 'string', 'max:255'],
        //     'school' => [''],
        //     'city' => [''],
        //     'birthyear' => ['']
        // ]);

        return Validator::make($data, [
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:8|max:20|confirmed',
            'username' => 'required|string|min:4|max:20',
            'name' => 'required|string|max:255',
            'school' => '-',
            'city' => '-',
            'birthyear' => '-'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $student = Student::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'name' => $data['name'],
            'school' => $data['school'],
            'city' => $data['city'],
            'birthyear' => $data['birthyear'],
            // 'role' => 'user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Role::create([
            'id_student' => $student->id
        ]);

        $ip = new InternetProtocolAddressController;
        LogApps::create([
            "id_user" => Student::firstWhere('email', $data['email'])['id'],
            "log_table" => "students",
            "log_path" => "RegisterController@create",
            "log_desc" => "Register New Student",
            "log_ip" => $ip->getIPAddress()
        ]);

        return $student;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return redirect('login');
    }
}
