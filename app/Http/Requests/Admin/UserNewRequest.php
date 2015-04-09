<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Auth;

class UserNewRequest extends Request {

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
			'name' => 'unique:users|required|min:5|max:10',
            'acronym' => 'unique:users|required|min:3|max:6',
            'email' => 'unique:users|required|email',
            'display_name' => 'required',
		];
	}

}
