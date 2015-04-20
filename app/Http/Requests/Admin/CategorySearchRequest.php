<?php namespace App\Http\Requests\Admin;


class CategorySearchRequest extends BaseRequest {

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
            'acronym' =>'',
            'order' => '',
            'display_name' => '',
            'parent' =>'',
            'description' =>''
        ];
	}

}
