<?php namespace App\Http\Requests\Admin;


class CategoryNewRequest extends BaseRequest {


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'unique:categories|required|min:2|max:10',
            'acronym' => 'unique:categories|required|min:2|max:10',
            'order' => 'integer',
            'display_name' => 'required',
            'description' => '',
        ];
    }

}
