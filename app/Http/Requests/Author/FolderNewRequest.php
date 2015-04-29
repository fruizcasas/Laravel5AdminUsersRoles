<?php namespace App\Http\Requests\Author;


class FolderNewRequest extends BaseRequest {


	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'name' => 'required|min:2',
            'order' => 'integer',
		];
	}

}
