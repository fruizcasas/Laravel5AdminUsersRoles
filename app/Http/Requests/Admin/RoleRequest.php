<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

use Auth;

class RoleRequest extends Request {

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
            'name' => 'required|min:5',
            'display_name' => 'required|min:5',
            'description' => '',
            'acronym' => 'required|min:3|max:5',
		];
	}

}
