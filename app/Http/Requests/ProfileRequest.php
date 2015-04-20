<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

class ProfileRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'per_page' => 'required|integer|min:5|max:100',
            'theme' => 'required',
            'show_trash' => '',
            'ckeditor' => 'required',
		];
	}

}
