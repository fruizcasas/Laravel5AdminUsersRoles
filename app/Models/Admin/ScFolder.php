<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ScFolder extends Model {


    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sc_folders';


    public function children()
    {
        return $this->hasMany('App\Models\Admin\Folder','folder_id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\Folder','folder_id');
    }


}
