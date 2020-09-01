<?php

namespace App\Http\Controllers\Saml;

use Aacotroneo\Saml2\Http\Controllers\Saml2Controller;
use Aacotroneo\Saml2\Saml2Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MySaml2Controller extends Saml2Controller
{
    public function logout(Saml2Auth $saml2Auth, Request $request)
    {
        $returnTo = $request->returnTo ? $request->return:url('account.logout');
        $sessionIndex = $request->sessionIndex ? $request->sessionIndex:Session::get('sessionIndex');
        $nameId = $request->nameId ? $request->nameId:Session::get('nameId');
        $saml2Auth->logout($returnTo, $nameId, $sessionIndex ); //will actually end up in the sls endpoint
    }
}
