<?php
/**
 * Created by PhpStorm.
 * User: tern.lan
 * Date: 2021-07-29
 * Time: 15:01
 */

namespace Starship\Log;


use Starship\Log\Drivers\FileLog;

class Log
{
    public static function info($message)
    {
        FileLog::getSingleton()->info($message);
    }

    public static function error($message)
    {
        FileLog::getSingleton()->error($message);
    }
}