<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Auth;


class BaseRequest extends Request {

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

}
