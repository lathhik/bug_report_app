<?php

namespace App\Helpers;

use DateTimeInterface;
use Exception;
use DateTime;
use DateTimeZone;

class App
{
    private $config = [];

    /**
     * @param mixed $name
     */
    public function __construct()
    {
        $this->config = Config::getFileContent('app');
    }

    /**
     * @param mixed
     * @return mixed string
     */
    public function getEnvironment(): string
    {
        if (!isset($this->config['env']))
            return 'production';
        return $this->isTestMode() ? 'test' :  $this->config['env'];
    }

    /**
     * @return boolean
     */
    public function isDebugged(): bool
    {
        if (!$this->config['debug']) {
            return false;
        }
        return $this->config['debug'];
    }


    /**
     * @return mixed string
     */
    public function getLogPath(): string
    {
        if (!isset($this->config['log_path']))
            throw new Exception('Log path is not defined');
        return $this->config['log_path'];
    }

    /**
     *  @return  boolean
     */
    public function isRunningFromConsole(): bool
    {
        return php_sapi_name() == 'cli' || php_sapi_name() == 'phpbg';
    }


    /**
     *  @return 
     */
    public function getServerTime(): DateTimeInterface
    {
        return new DateTime('now', new DateTimeZone('Asia/Kathmandu'));
    }

    /**
     *  @return boolean
     */
    public function isTestMode(): bool
    {
        if ($this->isRunningFromConsole() && defined('PHPUNIT_RUNNING') && PHPUNIT_RUNNING == true) {
            return true;
        }
        return false;
    }
}
