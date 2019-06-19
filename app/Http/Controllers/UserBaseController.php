<?php

namespace App\Http\Controllers;

use Route;
use Illuminate\Http\Request;

class UserBaseController extends Controller
{
    public $isApiCall = false;
    public $requestSource = null;
  
    /**
    * will include array of controllers that generic middleware not run
    * @var array
    */
    private $exceptAuthorizeControllers = [
        'Modules\Index\Http\Controllers\IndexController@index',
        'Modules\Index\Http\Controllers\IndexController@unauthorizedUser',
        'Modules\Users\Http\Controllers\AuthController@logout',
        'Modules\Core\Http\Controllers\AuthorizedAppsController@index',
    ];
  
    /**
    * Create a New controller instance.
    *
    * @return void
    */
    public function __construct(Request $request)
    {
        if ($request->call_type == 'api') {
            $this->middleware('auth:api');
            $this->isApiCall = true;
            $this->requestSource = 'app';
        }
        else {
            $this->middleware('auth');
            $this->requestSource = 'web';
        }

        if (!$this->isInExceptAuthorizeControllers()) {
            $this->middleware('authorize');
        }
    }
  
    /**
    * Check if current request Controller exist in except array
    * @return true if exist
    * @return false if not exist
    */
    public function isInExceptAuthorizeControllers()
    {
        if (in_array(Route::currentRouteAction(), $this->exceptAuthorizeControllers)) {
            return true;
        }
        else {
            return false;
        }
    }

}
