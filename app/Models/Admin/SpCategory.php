<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SpCategory extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sp_categories';


    public function children()
    {
        return $this->hasMany('App\Models\Admin\Category','category_id');
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\Category','category_id');
    }



}
