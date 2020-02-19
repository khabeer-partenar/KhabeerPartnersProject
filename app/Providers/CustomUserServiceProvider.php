<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 30/06/19
 * Time: 09:02 ص
 */

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider as UserProvider;

class CustomUserServiceProvider extends UserProvider
{
    public function retrieveById($identifier)
    {
        $model = $this->createModel();
        
        return $this->newModelQuery($model)
                    ->where($model->getAuthIdentifierName(), $identifier)
                    ->with('authorizedApps')
                    ->first();
    }
}