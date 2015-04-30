<?php namespace App;

use Zizaco\Entrust\EntrustRole;

/**
 * Class Role
 *
 * @package App
 * @property integer $id
 * @property string $name
 * @property string $acronym
 * @property string $display_name
 * @property string $description
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('auth.model')[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.permission')[] $perms
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereUpdatedAt($value)
 */
class Role extends EntrustRole
{

    const ADMIN = 'admin';
    const AUTHOR = 'author';
    const REVIEWER = 'reviewer';
    const APPROVER = 'approver';
    const PUBLISHER = 'publisher';

}
