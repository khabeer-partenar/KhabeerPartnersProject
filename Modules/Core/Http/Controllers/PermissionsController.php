<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Modules\Core\Transformers\User as UserTransformer;
use Modules\Users\Entities\User;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\Group;
use Yajra\Datatables\Datatables;
use Validator;

class PermissionsController extends UserBaseController
{

    /**
     * Display a listing of permissions
     * @return Response
     */
    public function index(Request $request, $id)
    {
        $model = Group::findOrFail($id);

        if ($request->wantsJson() || $request->ajax()) {
            return $model->permissions;
        }
        else {

            $permissionableType = 'groups';
            $typeShortcut = 'group_permissions';
            
            return view('core::permissions.index')
                    ->with('permissionableType', $permissionableType)
                    ->with('permissionableId', $id)
                    ->with('model', $model)
                    ->with('routeUrl', route($typeShortcut, ['id' => $id]));
        }
    }

    /**
    * @api {post} /core/groups/:id/permissions Create New permission
    * @apiName createPermission
    * @apiPermission Core
    *
    * @apiParam {Integer} app_id app id
    *
    * @apiSuccess (Success 200) {JsonObject} permissions permission information
    * @apiError (Unprocessable Entity 422) ValidationError
    */
    public function store(Request $request, $permissionable, $permissionableId)
    {
        if (!$request->has('permissionable_id') && !$request->has('permissionable_type')) {
            $this->updateRequestParams($request, $permissionable, $permissionableId);
        }

        $validator = Validator::make($request->all(), [
            'app_id' => 'required|numeric|exists:core_apps,id',
            'permissionable_type' => 'required|in:'. Permission::permissionablesToString(),
            'permissionable_id' => 'required|numeric'. Permission::getPermissionableExistsRule($permissionable),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $permissionableObject = $this->getPermissionableObject($permissionable, $permissionableId);

        $permission = $permissionableObject->permissions()->create($request->all());
        return $permission;
    }

    /**
     * @api {delete} /core/permissions/:id delete permission informations
     * @apiName deletePermission
     * @apiPermission Core
     *
     * @apiParam {Integer} id permission id
     *
     * @apiSuccess (Success 200) {JsonObject} permissions permission information
     * @apiError (NotFound 404) NotFound if permission id not found
     * @apiError (Unprocessable Entity 422) ValidationError
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return response(null, 204);
    }
   
    /**
    * Get permissionable object
    */
    public function updateRequestParams($request, $permissionable, $permissionableId)
    {
        $request->merge(['permissionable_id' => $permissionableId, 'permissionable_type' =>  $permissionable]);
    }

    public function getPermissionableObject($permissionable, $permissionableId)
    {
        $permissionableClassName = Permission::$availablePermissionables[$permissionable][1];
        $permissionableObject = $permissionableClassName::findOrFail($permissionableId);

        return $permissionableObject;
    }
    
}
