<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Users\Http\Requests\UpdateAccountRequest;
use App\Http\Controllers\UserBaseController;
use Modules\Core\Entities\Group;

class AccountController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $rolesData = Group::employeeRoles()->where('id', auth()->user()->job_role_id)->pluck('name', 'id');
        $receiveSmsOptions = [false => 'لا', true => 'نعم'];
        return view('users::account.edit', compact('rolesData', 'receiveSmsOptions'));
    }

    /**
     * Update the specified resource in storage.
     * @param  UpdateAccountRequest $request
     * @return Response
     */
    public function update(UpdateAccountRequest $request)
    {
        auth()->user()->update($request->only('receive_sms'));
        session()->flash('alert-success', __('users::account.accountUpdated'));
        return redirect()->route('account.edit');
    }

    /**
     * Logout the user from the system
     */
    public function logout(Request $request)
    {
        if($request->call_type == 'api') {
            auth()->user()->token()->revoke();
            return response()->json('success', 200);
        }
	Session::forget('sessionIndex');
        auth()->logout();
        return redirect()->to('/login');
    }

}
