<?php namespace App\Services;

use App\Http\Requests\Request;
use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Config;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|min:3|max:10',
            'display_name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users|regex:/@'.Config::get('DOMAIN_NAME','admin.com').'$/',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
            'display_name' => $data['display_name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
            'is_admin' => 'false',
            'is_employee' => 'false',
            'is_owner' => 'false',
            'is_reviewer' => 'false',
            'is_approver' => 'false',
            'is_signer' => 'false',
		]);
	}

}
