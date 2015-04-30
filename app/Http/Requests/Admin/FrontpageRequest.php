<?php namespace App\Http\Requests\Admin;


class FrontpageRequest extends BaseRequest {


	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'title' => 'required|min:2',
            'creation_date' => 'date',
            'description' => '',

        ];
	}

}
