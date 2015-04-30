<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Library\Utils;

/**
 * App\Models\Admin\Picture
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $filename
 * @property string $mime_type
 * @property string $extension
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Admin\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Picture whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Picture whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Picture whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Picture whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Picture whereExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Picture whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Picture whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Picture whereUpdatedAt($value)
 */
class Picture extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pictures';


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Admin\User');
    }


}
