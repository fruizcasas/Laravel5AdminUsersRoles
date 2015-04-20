<?php namespace App\Http\Requests\Admin;



class CategoryRequest extends BaseRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:10',
            'acronym' => 'required|min:2|max:10',
            'order' => 'integer',
            'display_name' => 'required',
        ];
    }

}
