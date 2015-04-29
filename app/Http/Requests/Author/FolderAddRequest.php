<?php namespace App\Http\Requests\Author;

class FolderAddRequest extends BaseRequest {


	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'addorder' => 'integer',
            'addname' => 'required|min:2',
		];
	}

}
