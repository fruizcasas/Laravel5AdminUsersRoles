<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;

/**
 * App\Models\Admin\FrontPage
 *
 * @property integer $id 
 * @property string $code 
 * @property integer $edition 
 * @property string $status 
 * @property string $review_date 
 * @property string $publishing_date 
 * @property integer $total_pages 
 * @property string $title 
 * @property string $reason_for_revision 
 * @property integer $author_id 
 * @property integer $reviewer_id 
 * @property integer $approver_id 
 * @property integer $publisher_id 
 * @property string $description 
 * @property \Carbon\Carbon $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereEdition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereReviewDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage wherePublishingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereTotalPages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereReasonForRevision($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereAuthorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereReviewerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereApproverId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage wherePublisherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\FrontPage whereUpdatedAt($value)
 * @method static \App\Models\Admin\FrontPage sortable($view)
 */
class FrontPage extends Model
{

    use SortableTrait;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'frontpages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'edition',
        'status',
        'review_date',
        'publishing_date',
        'total_pages',
        'title',
        'reason_for_revision',
        'author_id',
        'reviewer_id',
        'approver_id',
        'publisher_id',
        'description',
        'description'];


}
