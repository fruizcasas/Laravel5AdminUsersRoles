<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Auth;

class DepartmentNewRequest extends Request {

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
            'name' => 'unique:departments|required|min:2|max:10',
            'acronym' => 'unique:departments|required|min:2|max:10',
            'display_name' => 'required',
            'description' => '',
        ];
	}

}
