<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;

/**
 * App\Models\Admin\Fileentry
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $original_name
 * @property string $original_mime_type
 * @property string $original_extension
 * @property string $name
 * @property string $mime_type
 * @property string $extension
 * @property integer $size
 * @property string $sha1
 * @property string $error
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Admin\User $uploader
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereOriginalName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereOriginalMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereOriginalExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereSha1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereError($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Fileentry whereUpdatedAt($value)
 * @method static \App\Models\Admin\Fileentry sortable($view)
 */
class Fileentry extends Model {

    use SortableTrait;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fileentries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'original_name',
        'original_mime_type',
        'original_extension',
        'name',
        'mime_type',
        'extension',
        'size',
    ];



    /* Get the post's author.
     *
     * @return User
     */
    public function uploader()
    {
        return $this->belongsTo('App\Models\Admin\User');
    }

}
