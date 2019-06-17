<?php
namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Entities\Core\User;

class Permission extends Model
{
    use \Modules\Core\Traits\SharedModel;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'core_permissions';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['app_id'];

    /**
     * Available permissionable models
     *
     * @var array
     */
    public static $availablePermissionables = [
        'groups' => ['core_groups,id', 'Modules\Core\Entities\Group'],
    ];

    /**
     * Get permissionable
     */
    public function permissionable()
    {
        return $this->morphTo();
    }

    /**
     * Get by group ids
     * @param Array groups ids
     */
    public static function queryByGroupIds($groupIds)
    {
        return self::where('permissionable_type', self::$availablePermissionables["groups"][1])
                    ->whereIn('permissionable_id', $groupIds);
    }
    
    /**
     * Get permissionable models as comma seperated string
     */
    public static function permissionablesToString()
    {
        return join(',', array_keys(self::$availablePermissionables));
    }
    
    /**
     * Get permissionable table and key
     */
    public static function getPermissionableExistsRule($permissionable)
    {
        if (array_key_exists($permissionable, self::$availablePermissionables)) {
            return '|exists:'. self::$availablePermissionables[$permissionable][0];
        } else {
            return '';
        }
    }

    /*
    * Check if group permisison
    */
    public function isGroupPermission()
    {
        if ($this->permissionable_type == self::$availablePermissionables["groups"][1]) {
            return true;
        } else {
            return false;
        }
    }

}
