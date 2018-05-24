<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use Config;
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $userconfig = Config::get('constants.users_options');
		if($userconfig['passwordtype'] == 'easy')
			$password_length = 'digits_between:8,12';
		
		if($userconfig['passwordtype'] == 'normal')
			$password_length = 'digits_between:12,20';
		
		if($userconfig['passwordtype'] == 'complex')
			$password_length = 'digits_between:12,20';
		
		$username = 'required|string|email|min:' . $userconfig['usernameminlength'] . '|max:' . $userconfig['usernamemaxlength'] . '|unique:users';
        $password = 'bail|required|string|confirmed|' . $password_length .'|password_'.$userconfig['passwordtype'];

        return Validator::make($data, [
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'mobile' => 'required|numeric|unique:users',
            'date_of_birth' => 'required',
            'email' => $username,
            'username' => 'required',
            'password' => $password,
            'location_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'default_module_id' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $userconfig = Config::get('constants.users_options');
		$user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'password_key' => md5($data['password']),
            'password_expire_days' => $userconfig['passwordexpireduration'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'date_of_birth' => Carbon::parse($data['date_of_birth'])->format('Y-m-d H:i:s'),
            'location_id' => $data['location_id'],
            'department_id' => $data['department_id'],
            'designation_id' => $data['designation_id'],
            'default_module_id' => $data['default_module_id'],
        ]);


        if (count($data['user_module_id']) > 0) {
            foreach ($data['user_module_id'] as $mval) {
                if ($mval > 0) {
                    DB::table('privilege_modules')->insert(
                        [
                            'users_id' => $user->id,
                            'modules_id' => $mval,
                            'created_at' => Carbon::today()
                        ]
                    );
                }
            }
        }

        if (count($data['user_level_id']) > 0) {
            foreach ($data['user_level_id'] as $lval) {
                if ($lval > 0) {
                    DB::table('privilege_levels')->insert(
                        [
                            'users_id' => $user->id,
                            'user_levels_id' => $lval,
                            'created_at' => Carbon::today()
                        ]
                    );
                }
            }

        }

        return $user;
    }
}
