<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SortableTrait;

/**
 * App\Fileentry
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $original_name
 * @property string $original_mime_type
 * @property string $original_extension
 * @property string $name
 * @property string $mime_type
 * @property string $extension
 * @property integer $size
 * @property string $sha1
 * @property string $error
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $uploader
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereOriginalName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereOriginalMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereOriginalExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereSha1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereError($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fileentry whereUpdatedAt($value)
 */
class Fileentry extends Model {

    /* Get the post's author.
     *
     * @return User
     */
    public function uploader()
    {
        return $this->belongsTo('App\User');
    }

}
