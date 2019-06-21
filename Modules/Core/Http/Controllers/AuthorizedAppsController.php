<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserBaseController;
use Modules\Core\Transformers\App as AppTransformer;
use Modules\Core\Entities\App;

class AuthorizedAppsController extends UserBaseController
{
    
    /**
    * @api {get} /core/authorized-apps Get users athorized apps list
    * @apiName getUserAuthorizedApps
    * @apiApp Core
    * @apiSuccess (Success 200) {JsonArray} apps list
    */
    public function index(Request $request)
    {
        if ($request->user()->is_super_admin) {
            $apps = App::parentsFormMenu()
                       ->with('menuChildrenRecursive')
                       ->get();
            return new AppTransformer($apps);
        }
        else {
            $authorizedAppIds = $request->user()->authorizedAppsIds();

            App::setAuthorizedApps($authorizedAppIds);

            $apps = App::parentsFormMenu()
                       ->with('menuChildrenRecursive')
                       ->get();
            return new AppTransformer($apps);
        }
    }

}
