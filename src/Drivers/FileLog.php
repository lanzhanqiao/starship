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
    protected $messages = [];
    public $logDir = './runtime/logs/';

    static private $instance = null;

    private function __construct()
    {
        register_shutdown_function([$this, 'flush']);
    }

    /**
     * 获取单例
     *
     * @return FileLog|null
     */
    static public function getSingleton()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function log($level, $message, array $context = array())
    {
        $this->messages[] = $this->parseMessage(compact('level', 'message'));
    }

    /**
     * 内容格式化
     *
     * @param $params
     * @return string
     */
    protected function parseMessage($params)
    {
        return date("Y-m-d H:i:s")."-----".$params['level']."-------".$params['message'];
    }

    /**
     * 刷新日志到文件
     */
    public function flush()
    {
        if (empty($this->messages)) {
            return;
        }
        $handle = fopen($this->getFile(), 'a+');
        fwrite($handle, implode(PHP_EOL, $this->messages).PHP_EOL);
        fclose($handle);
        $this->messages = [];
    }

    /**
     * 获取日志文件
     * @return string
     */
    protected function getFile()
    {
        is_dir($this->logDir) || @mkdir($this->logDir, 0777);

        return $this->logDir.date("Y-m-d").'.log';
    }

    private function __clone()
    {
    }
}