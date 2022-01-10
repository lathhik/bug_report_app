<?php

namespace App\Logger;

use App\Contracts\LoggerInterface;
use App\Exception\InvalidLogLevelArgumentException;
use App\Helpers\App;
use ReflectionClass;

class Logger implements LoggerInterface
{

    /**
     *
     * @param string $message 
     * @param array $context 
     *
     * @return mixed
     */
    function emergency(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     *
     * @param string $message 
     * @param array $context 
     *
     * @return mixed
     */
    function info(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::INFO, $message, $context);
    }

    /**
     *
     * @param string $message , $context
     * @param array $context 
     *
     * @return mixed
     */
    function warning(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::WARNING, $message, $context);
    }

    /**
     *
     * @param string $message , $context
     * @param array $context 
     *
     * @return mixed
     */
    function notice(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::NOTICE, $message, $context);
    }

    /**
     *
     * @param string $message , $context
     * @param array $context 
     *
     * @return mixed
     */
    function alert(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::ALERT, $message, $context);
    }

    /**
     *
     * @param string $message , $context
     * @param array $context 
     *
     * @return mixed
     */
    function critical(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::CRITICAL, $message, $context);
    }

    /**
     *
     * @param string $message , $context
     * @param array $context 
     *
     * @return mixed
     */
    function debug(string $message, array $context = [])
    {
        $this->addRecord(LogLevel::DEBUG, $message, $context);
    }


    /**
     *
     * @param string $level 
     * @param string $message , $context
     * @param array $context 
     *
     * @return mixed
     */
    function log(string $level, string $message, array $context = [])
    {
        $log_level_object = new ReflectionClass(LogLevel::class);
        $valid_log_levels = $log_level_object->getConstants();
        if (!in_array($level, $valid_log_levels)) {
            throw new InvalidLogLevelArgumentException($level, $valid_log_levels);
        }
        $this->addRecord($level, $message, $context);
    }

    /**
     * @param mixed $level
     */
    public function addRecord($level, string $message, array $context = [])
    {
        $application = new App;
        $logPath = $application->getLogPath();
        $env = $application->getEnvironment();
        $date = $application->getServerTime()->format('Y-m-d H:i:s');

        $details = sprintf(
            '%s - Level: %s - Message: %s - Context: %s',
            $date,
            $level,
            $message,
            json_encode($context)
        ) . PHP_EOL;
        $filename = sprintf('%s/%s-%s.log', $logPath, $env, date('j.n.Y'));
        file_put_contents($filename, $details, FILE_APPEND);
    }
}
