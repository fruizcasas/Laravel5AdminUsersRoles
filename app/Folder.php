<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Folder
 *
 * @property integer $id
 * @property string $name
 * @property integer $folder_id
 * @property integer $user_id
 * @property string $description
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Folder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Folder whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Folder whereFolderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Folder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Folder whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Folder whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Folder whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Folder whereUpdatedAt($value)
 * @property integer $order
 * @property integer $root_id
 * @property boolean $private
 * @method static \Illuminate\Database\Query\Builder|\App\Folder whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Folder whereRootId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Folder wherePrivate($value)
 */
class Folder extends Model {

	//

}
