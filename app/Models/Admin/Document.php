<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;


/**
 * App\Models\Admin\Document
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $mime_type
 * @property string $extension
 * @property string $title
 * @property string $description
 * @property string $original_name
 * @property string $original_mime_type
 * @property string $original_extension
 * @property integer $size
 * @property string $sha1
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereOriginalName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereOriginalMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereOriginalExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereSha1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereUpdatedAt($value)
 * @method static \App\Models\Admin\Document sortable($view)
 */
class Document extends Model
{

    use SortableTrait;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'mime_type',
        'extension',
        'title',
        'description',
        'original_name',
        'original_mime_type',
        'original_extension',
        'size',
    ];

    /**
     * @return mixed
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\Admin\User', 'user_id');
    }

}
