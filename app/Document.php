<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Document
 *
 * @property integer $id 
 * @property string $name 
 * @property string $title 
 * @property integer $user_id 
 * @property string $mime 
 * @property string $storage_path 
 * @property string $description 
 * @property string $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereMime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereStoragePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Document whereUpdatedAt($value)
 */
class Document extends Model {

	//

}
