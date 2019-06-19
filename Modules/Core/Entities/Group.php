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
    public static $unifiedGroups = [
        'university' => 'es_university_group',
        'govern_employees' => 'es_university_govern_employees_group',
        'direct_managers' => 'es_univeristy_direct_managers',
        'parent_managers' => 'es_univeristy_parent_managers',
        'es_management_and_financial_group' => 'es_management_and_financial_group',
        'parent_managers_and_deans_who_dont_have_emps' => 'parent_managers_and_deans_who_dont_have_emps',
        'clearance_form_group' => 'clearance_form_group',
    ];


    /**
    * Get permissions specified for group
    */
    public function permissions()
    {
        return $this->morphMany(Permission::class, 'permissionable');
    }
 
    /**
    * Get group users
    */
    public function users()
    {
        return $this->belongsToMany(User::class, 'core_users_groups', 'core_group_id', 'user_id');
    }
  
    public static function findByKey($key)
    {
        return self::where('key', '=' ,$key)->first();
    }
    
    public static function findUnifiedGroupByName($name)
    {
        return self::findByKey(self::$unifiedGroups[$name]);
    }
  
    public static function hasUserByKey($key, $user)
    {
        $group = self::findByKey($key);
        return $group->hasUser($user);
    }
  
    public function hasUser($user)
    {
        $user = $this->users()
                    ->where(User::table().'.user_id', '=', $user->user_id)
                    ->first();
        return ($user == null ? false : true);
    }

}