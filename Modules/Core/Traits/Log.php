<?php

namespace Modules\Core\Traits;

use Modules\Core\Entities\Log as LogModel; 

trait Log
{

    /**
    * Return Table Name
    */
    public function log($actionName)
    {
        LogModel::create([
            'user_id' => auth()->user()->id,
            'user_ip' => request()->ip(),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
            'action_name' => $actionName,
            'table_name' => self::table(),
            'primary_id' => $this->id,
            'body' => $this,
        ]);
    }
    
}
