<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App
 */
class Role extends Model
{

    const ADMIN = 'admin';
    const OWNER = 'owner';
    const REVIEWER = 'reviewer';
    const APPROVER = 'approver';
    const SIGNER = 'signer';


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

}
