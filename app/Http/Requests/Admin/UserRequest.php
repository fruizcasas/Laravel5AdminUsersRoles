<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

use Auth;
use App\Role;

class UserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::user()->hasRole(Role::ADMIN);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|min:5',
            'email' => 'required|email'
		];
	}

}
