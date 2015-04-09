<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Auth;

class UserSearchRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        if (Auth::check()) {
            return Auth::user()->is_admin;
        }
        return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'id' => '',
			'name' => '',
            'acronym' => '',
            'email' => '',
            'is_admin' =>'',
            'is_author' =>'',
            'is_reviewer' =>'',
            'is_approver' =>'',
            'is_publisher' =>'',
            'roles' => '',
            'departments' => '',
		];
	}

}
