<?php
/**
 * @author Mamdouh Magdy <mamdouh95@mu.edu.sa>
 */

namespace Modules\Users\Traits;

use Illuminate\Support\Facades\Session;

trait SessionFlash {

    public function sessionSuccess($msg = 'general.done successfaully')
    {
        return session::flash('alert-success', __("$msg"));
    }
}