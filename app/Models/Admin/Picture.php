<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Library\Utils;

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
