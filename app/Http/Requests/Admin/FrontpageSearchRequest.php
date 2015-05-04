<?php namespace App\Http\Requests\Admin;


class FrontpageSearchRequest extends BaseRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'id',
            'code',
            'edition',
            'status',
            'total_pages ',
            'title',
            'reason_for_revision',
            'author_id',
            'creation_date',
            'reviewer_id',
            'review_date',
            'approver_id',
            'approval_date',
            'publisher_id',
            'publishing_date',
        ];
	}

}
