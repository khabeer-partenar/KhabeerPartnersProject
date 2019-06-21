<?php
namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\User;
use Modules\Core\Entities\Permission;

class Group extends Model
{

    use \Modules\Core\Traits\SharedModel;
    
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'core_groups';

    /**
    * The attributes that are mass assignable
    *
    * @var array
    */
    protected $fillable = ['parent_id', 'name', 'key'];
  
    /**
    * unified groups keys
    *
    * @var array
    */
    public static $unifiedGroups = [];


    /**
    * Get permissions specified for group
    */
    public function permissions()
    {
        return $this->morphMany(Permission::class, 'permissionable');
    }

    /**
     * Scopes
     *
     * Here you should write Scopes
     *
     */
    public static function scopeGetAll($query)
    {
        return $query->pluck('name', 'id')->prepend('', '');
    }


    /**
    * Get group users
    */
    public function users()
    {
        return $this->belongsToMany(User::class, 'core_users_groups', 'core_group_id', 'id');
    }
  
    public static function findByKey($key)
    {
        return self::where('key', '=' ,$key)->with('users')->first();
    }
  
    public static function hasUserByKey($key, $user)
    {
        $group = self::findByKey($key);
        return $group->hasUser($user);
    }
  
    public function hasUser($user)
    {
        $user = $this->users()
                    ->where(User::table().'.id', '=', $user->id)
                    ->first();
        return ($user == null ? false : true);
    }

}