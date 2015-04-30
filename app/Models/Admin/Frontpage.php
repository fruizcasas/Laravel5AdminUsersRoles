<?php namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;



/**
 * App\Models\Admin\Frontpage
 *
 * @property integer $id 
 * @property string $code 
 * @property integer $edition 
 * @property string $status 
 * @property \Carbon\Carbon $creation_date 
 * @property \Carbon\Carbon $review_date 
 * @property \Carbon\Carbon $approval_date 
 * @property \Carbon\Carbon $publishing_date 
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
 * @property-read \App\Models\Admin\User $author 
 * @property-read \App\Models\Admin\User $reviewer 
 * @property-read \App\Models\Admin\User $approver 
 * @property-read \App\Models\Admin\User $publisher 
 * @property-read mixed $display_name 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereEdition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereCreationDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereReviewDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereApprovalDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage wherePublishingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereTotalPages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereReasonForRevision($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereAuthorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereReviewerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereApproverId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage wherePublisherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Frontpage whereUpdatedAt($value)
 * @method static \App\Models\Admin\Frontpage sortable($view)
 */
class Frontpage extends Model
{

    use SortableTrait;

    use SoftDeletes;

    protected $dates = [
        'deleted_at',
        'creation_date',
        'review_date',
        'approval_date',
        'publishing_date'
    ];

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
        'creation_date',
        'review_date',
        'approval_date',
        'publishing_date',
        'total_pages',
        'title',
        'reason_for_revision',
        'author_id',
        'reviewer_id',
        'approver_id',
        'publisher_id',
        'description'];


    /**
     * @return mixed
     */
    public function author()
    {
        return $this->belongsTo('App\Models\Admin\User', 'author_id');
    }
    /**
     * @return mixed
     */
    public function reviewer()
    {
        return $this->belongsTo('App\Models\Admin\User', 'reviewer_id');
    }
    /**
     * @return mixed
     */
    public function approver()
    {
        return $this->belongsTo('App\Models\Admin\User', 'approver_id');
    }
    /**
     * @return mixed
     */
    public function publisher()
    {
        return $this->belongsTo('App\Models\Admin\User', 'publisher_id');
    }

    public function getDisplayNameAttribute()
    {
        return $this->code.'-'.sprintf('%02.2d',$this->edition).':'.$this->title;
    }

    public function getCreationDateAttribute($value)
    {
        $d = new Carbon($value);
        return $d->toDateString();
    }

}
