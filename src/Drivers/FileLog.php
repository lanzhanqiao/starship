<?php
/**
 * Created by PhpStorm.
 * User: tern.lan
 * Date: 2021-07-29
 * Time: 11:51
 */
namespace Starship\Log\Drivers;

use Psr\Log\AbstractLogger;

class FileLog extends AbstractLogger
{
    public $error = [];

    static private $instance = null;

    private function __construct()
    {
    }

    static public function getSingleton()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function log($level, $message, array $context = array())
    {
        $this->error[] = [
            'level' => $level,
            'message' => $message,
            'context' => $context,
        ];

        var_dump($this->error);
    }

    private function __clone()
    {
    }
}