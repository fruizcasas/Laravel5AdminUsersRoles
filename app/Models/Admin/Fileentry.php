<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\SortableTrait;

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


    /* Get the post's author.
     *
     * @return User
     */
    public function uploader()
    {
        return $this->belongsTo('App\Models\Admin\User');
    }

}
