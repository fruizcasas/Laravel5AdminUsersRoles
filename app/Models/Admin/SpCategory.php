<?php namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Admin\SpCategory
 *
 * @property integer $id
 * @property string $name
 * @property string $acronym
 * @property string $display_name
 * @property integer $category_id
 * @property integer $order
 * @property string $description
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Category[] $children
 * @property-read \App\Models\Admin\Category $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpCategory whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpCategory whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpCategory whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpCategory whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\SpCategory whereUpdatedAt($value)
 */
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
        return $this->hasMany('App\Models\Admin\Category','category_id')->withTrashed();
    }


    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\Category','category_id')->withTrashed();
    }



}
