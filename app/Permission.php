<?php namespace App;

use Zizaco\Entrust\EntrustPermission;

/**
 * App\Permission
 *
 * @property integer $id
 * @property string $name
 * @property string $acronym
 * @property string $display_name
 * @property string $description
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Config::get('entrust.role')[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereAcronym($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereUpdatedAt($value)
 */
class Permission extends EntrustPermission
{

}