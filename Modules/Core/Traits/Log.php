<?php

namespace Modules\Core\Traits;

use Modules\Core\Entities\Log as LogModel; 

trait Log
{

    /**
    * Return Table Name
    */
    public static function log($actionName, $payload)
    {
        LogModel::create([
            'user_id' => auth()->user()->id,
            'user_ip' => request()->ip(),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
            'action_name' => $actionName,
            'table_name' => self::table(),
            'primary_id' => $payload->id,
            'body' => $payload,
        ]);
    }
    
}
