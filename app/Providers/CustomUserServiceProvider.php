<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 30/06/19
 * Time: 09:02 ص
 */

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider as UserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use App\Classes\Date\CarbonHijri;
use Carbon\Carbon;
use Modules\Core\Entities\App;

class CustomUserServiceProvider extends UserProvider
{
    public function retrieveById($identifier)
    {
        $model = $this->createModel();
        
        $userData = $this->newModelQuery($model)
                    ->where($model->getAuthIdentifierName(), $identifier)
                    ->with('authorizedApps')
                    ->first();

        if ($userData->is_super_admin) {
            $apps = App::parentsFormMenu()->with('menuChildrenRecursive')->get();
        }
        else {
            $authorizedAppIds = $userData->authorizedAppsIds();
            App::setAuthorizedApps($authorizedAppIds);
            $apps = App::parentsFormMenu()->with('menuChildrenRecursive')->get();
        }

        \View::share([
            'authorizedApps' => $apps
        ]);
        return $userData;
    }
}