<?php
namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\SharedModel;
use Modules\Users\Entities\User;
use Modules\Core\Entities\Permission;
use Modules\Core\Traits\Log;

class Group extends Model
{
    use SharedModel, Log;
    
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
        return $this->belongsToMany(User::class, 'core_users_groups', 'core_group_id', 'user_id');
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


    /**
     * Get the president in users
     */
    public static function presidentsUsers()
    {
        return optional(self::findByKey('office_of_the_president'))->users;
    }

    /**
     * Get advisor in users
     */
    public static function advisorsUsers()
    {
        return optional(self::findByKey('advisor'))->users;
    }

    public static function advisorUsersFilter()
    {
        $group = optional(self::findByKey('advisor'));
        return $group->users();
    }

    /**
     * Get director of consultants office in users
     */
    public static function directorOfConsultantsUsers()
    {
        return optional(self::findByKey('director_of_consultants_offices'))->users;
    }

    /**
     * Get secretaries in employees
     */
    public static function secretariesEmployees()
    {
        return optional(self::findByKey('secretary'))->users;
    }

    /**
     * Get associate consultants in users
     */
    public static function associateConsultantsUsers()
    {
        return optional(self::findByKey('associate_consultant'))->users;
    }

    /**
     * Get portfolio managers in users
     */
    public static function portfolioManagersUsers()
    {
        return optional(self::findByKey('portfolio_manager'))->users;
    }

    /**
     * Get technical supports in users
     */
    public static function technicalSupportsUsers()
    {
        return optional(self::findByKey('technical_support'))->users;
    }

    /**
     * Get ministers in users
     */
    public static function ministersUsers()
    {
        return optional(self::findByKey('minister'))->users;
    }

    /**
     * Get director of ministers office in users
     */
    public static function directorOfMinistersUsers()
    {
        return optional(self::findByKey('director_of_the_minister_office'))->users;
    }

    /**
     * Get coordinators in users
     */
    public static function coordinatorsUsers()
    {
        return optional(self::findByKey('coordinator'))->users;
    }

    /**
     * Get delegates in users
     */
    public static function delegatesUsers()
    {
        return optional(self::findByKey('delegate'))->users;
    }

    /**
     * Get acting delegates in users
     */
    public static function actingDelegatesUsers()
    {
        return optional(self::findByKey('acting_delegate'))->users;
    }

    public static function chairmanOfCommission()
    {
        return optional(self::findByKey('chairman_of_the_commission'))->users;
    }

    public static function viceChairmanOfCommission()
    {
        return optional(self::findByKey('vice_chairman_of_the_commission'))->users;
    }
}