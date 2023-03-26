<?php

namespace Osky\WordpressPluginLogger;

use Osky\WordpressPluginLogger\Config\Message;
use Osky\WordpressPluginLogger\Config\Path;
use Osky\WordpressPluginLogger\Config\Timestamp;
use Osky\WordpressPluginLogger\Config\Timezone;

class Log
{
    public static bool|null $isp;
    public static string|null $path;
    public static string|null $pluginName;
    public static string|null $ts;
    public static string|null $tz;
    public static $pth;
    public static string|null $newPath = null;
    
    public function __construct(bool|null $isPlugin = true, string|null $path = null, string|null $pluginName = null, string $timestamp = 'd-m-Y h.i A', string|null $timezone = 'Asia/Kuala_Lumpur', string $logSize = '419430400')
    {
        self::$isp = $isPlugin;
        self::$pth = new Path($path, $pluginName, $logSize);
        $objTimezone  = new Timezone($timezone);
        self::$tz  = $objTimezone->__invoke();
        $objTimestamp  = new Timestamp($timestamp);
        self::$ts  = $objTimestamp->__invoke();
        

    }

    public static function info($message)
    {
        $msg = new Message($message);
        self::write_log(__FUNCTION__, $msg->__invoke());
    }

    public static function debug($message)
    {
        $msg = new Message($message);
        self::write_log(__FUNCTION__, $msg->__invoke());
    }

    public static function error($message)
    {
        $msg = new Message($message);
        self::write_log(__FUNCTION__, $msg->__invoke());
    }

    private static function set_level($level)
    {
        switch ($level) {
            case 'info':
                return '<span style="color: #000000">'. $level .'</span>';
                break;
            case 'debug':
                return sprintf("\033[33m%s\033[0m", $level);
                break;
            case 'error':
                return sprintf("\033[31m%s\033[0m", $level);
                break;
            default:
                return sprintf("\033[34m%s\033[0m", $level);
                break;
        }
        
    }

    private static function write_log($level, $message) 
    {
        // setting up path 
        static::$newPath = ( static::$isp ) 
            ? static::$pth->wordpressPlugin() 
            : static::$pth->wordpress();

        file_put_contents(
            static::$newPath,
            static::$ts . '( Log::' .$level. ' ) ' . $message ."\n",
            FILE_APPEND
        );
    }
}