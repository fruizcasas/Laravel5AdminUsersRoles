<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;


/**
 * App\Models\Admin\Document
 *
 * @property integer $id 
 * @property string $name 
 * @property string $title 
 * @property integer $user_id 
 * @property string $mime 
 * @property string $storage_path 
 * @property string $description 
 * @property \Carbon\Carbon $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereMime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereStoragePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\Document whereUpdatedAt($value)
 * @method static \App\Models\Admin\Document sortable($view)
 */
class Document extends Model {

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
    protected $fillable = ['name','title', 'mime','storage_path','description'];


}
