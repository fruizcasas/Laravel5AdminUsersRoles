<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpUser extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sp_users';


    public function children()
    {
        return $this->hasMany('App\Models\Admin\User','user_id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\User','user_id');
    }


}
