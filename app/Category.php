<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property integer $id 
 * @property string $name 
 * @property string $acronym 
 * @property string $display_name 
 * @property integer $category_id 
 * @property string $description 
 * @property string $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereUpdatedAt($value)
 */
class Category extends Model {

	//

}
