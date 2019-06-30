<?php
namespace Modules\Core\Traits;

use Modules\Core\Entities\Group;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\App;

trait AuthorizeUser
{

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var Object permission
    */
    public $currentPermission = null;

    /**
     * Set current permission
     * @param Permission $currentPermission
    */
    public function setCurrentPermission($currentPermission)
    {
        $this->currentPermission = $currentPermission;
    }

    /**
     * Return all user own permissions in addition to user groups permissions
     * @param Integer $app_id
     */
    public function allPermissions($app_id = false)
    {
        $groupPermissions = Permission::queryByGroupIds($this->groups()->pluck(Group::table().'.id'));

        if ($app_id != false) {
            $groupPermissions = $groupPermissions->where('app_id', $app_id);
        }
        
        return $groupPermissions;
    }


    /**
      * Check if user has a permission for a specified resource name
      * @param String namespaced resource name
      * @return permission if true
      * @return false if not found
    */
    public function hasPermission($resourceName)
    {
        $app = App::where('resource_name', $resourceName)->first();

        if ($app == null) {
            return false;
        }
        
        $permissions = $this->allPermissions($app->id)->get();

        foreach ($permissions as $permission) {
            if ($permission->isGroupPermission()) {
                return true;
            }
        }

        return false;
    }

    public function hasPermissionO($resourceName)
    {
        if ($job = auth()->user()->jobRole) {
            foreach($job->permissions as $permission) {
                if ($permission->has('app')) {
                    if ($permission->app->resource_name == $resourceName) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
       * Check if user has a permission
       * @param String namespaced app key
       * @return false if not found
       */
    public function hasPermissionWithAccess($actionName, $controllerName = false, $moduleName = false)
    {
        if(auth()->user()->is_super_admin) {
            return true;
        }

        if(!$controllerName || !$moduleName) {
            $currentRoute = \Route::getCurrentRoute()->getAction()['controller'];
            $currentRoute = explode('\\', $currentRoute);
        }

        if(!$controllerName) {
            $controllerName  = explode('@', end($currentRoute))[0];
        }

        if(!$moduleName) {
            $moduleName = $currentRoute[1];
        }

        $resourceName = 'Modules\\'. $moduleName .'\\Http\Controllers\\'. $controllerName .'@'. $actionName;
        $permission   = $this->hasPermissionO($resourceName);
        
        if ($permission) {
            return true;
        }

        return false;
    }

    /**
     * Get User authorized apps ids
     * @param Array $excludedIds Ids to be execluded from arrray
     * @return Array authorized ids
     */
    public function authorizedAppsIds($excludedIds = [])
    {
        $ids = $this->allPermissions()->get()->pluck('app_id')->toArray();
        if (!empty($excludedIds)) {
            return array_diff($ids, $excludedIds);
        } else {
            return $ids;
        }
    }

}
