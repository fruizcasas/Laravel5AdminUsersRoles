<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Auth;

class FileentrySearchRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return Auth::user()->is_admin;
        };
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
            'original_name' => '',
            'original_mime_type' => '',
            'original_extension' => '',
            'name' => '',
            'mime_type' => '',
            'extension' => '',
            'size' => '',
        ];
    }

}
