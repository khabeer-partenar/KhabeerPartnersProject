<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Modules\Users\Entities\User;
use Modules\Core\Entities\Permission;
use Yajra\Datatables\Datatables;

class UsersController extends UserBaseController
{
    
    /**
     * Display a listing of the apps.
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $users = User::select('id', 'name', 'national_id', 'email', 'is_super_admin');

            $upgrateToSuperAdminPermission = auth()->user()->hasPermissionWithAccess('upgrateToSuperAdmin');

            return Datatables::of($users)
               ->addColumn('action', function ($user) use ($upgrateToSuperAdminPermission) {
                   $actionColumn = null;
                
                   if($upgrateToSuperAdminPermission) {
                        $actionColumn .= '
                            <a href="'.route('users.upgrate_to_super_admin', ['id' => $user->id]).'" class="btn btn-xs btn-'. ($user->is_super_admin == 1 ? 'danger' : 'primary') .' makeSuperAdmin">
                                <i class="fa fa-key"></i> Admin
                            </a>';
                   }

                   return $actionColumn;
               })
               ->make(true);
        }
        
        return view('core::users.index');
    }

    /**
     * search in users
     */
    public function search(Request $request)
    {
        $users = User::search($request->input('query'))
                   ->select('id', 'name', 'national_id')
                   ->get();
        
        return $users;
    }

    /**
     * update user to super admin or downgrade him to normal user
     */
    public function upgrateToSuperAdmin(Request $request, $userID) 
    {
        $userData = User::findOrFail($userID);
        $userData->is_super_admin = !$userData->is_super_admin;
        $userData->save();

        session()->flash('alert-success', __('messages.updatedـsuccessfully')); 
        return redirect()->route('users.index');
    }
}
