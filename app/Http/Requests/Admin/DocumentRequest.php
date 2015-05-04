<?php namespace App\Http\Requests\Admin;


class DocumentRequest extends BaseRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'title' => '',
            'user_id' => '',
            'original_name' => '',
            'original_mime_type' => '',
            'original_extension' => '',
            'name' => '',
            'mime_type' => '',
            'extension' => '',
            'size' => '',
            'file_upload' =>'',
            'description' =>'',
        ];
	}

}
