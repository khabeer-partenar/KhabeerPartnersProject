<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Yajra\Datatables\Datatables;
use Modules\Users\Entities\User;

class UserController extends UserBaseController
{

    /**
     * search in users
     */
    public function search(Request $request)
    {
        $usersData = User::search($request->input('search'))->select('id', 'name', 'national_id', 'email', 'phone_number', 'is_super_admin')->get();
        return response()->json($usersData, 200);
    }
    
    /**
     * update user to super admin or downgrade him to normal user
     */
    public function upgrateToSuperAdmin(Request $request, User $user)
    {
        $user->is_super_admin = !$user->is_super_admin;
        if(User::where('is_super_admin', 1)->count() == 1 && $user->is_super_admin == 0) {
            return back();
        }

        $user->save();

        session()->flash('alert-success', __('messages.updatedـsuccessfully')); 
        return redirect()->route('employees.index');
    }

}
