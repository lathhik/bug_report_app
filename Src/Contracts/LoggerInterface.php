<?php

namespace App\Contracts;

interface LoggerInterface
{
    /** 
     * @param string $message
     * @param array $context 
     */
    public function emergency(string $message,  array $context = []);

    /**
     * @param mixed $message
     * @param array $context
     */
    public function info(string $message,  array $context = []);

    /**
     * @param mixed $message , $context
     */
    public function warning(string $message,  array $context = []);

    /**
     * @param mixed $message , $context
     */
    public function notice(string $message,  array $context = []);

    /**
     * @param mixed $message , $context
     */
    public function alert(string $message,  array $context = []);

    /**
     * @param mixed $message , $context
     */
    public function critical(string $message,  array $context = []);

    /**
     * @param mixed $message , $context
     */
    public function debug(string $message,  array $context = []);

    /**
     * @param mixed $message , $context
     */
    public function log(string $level, string $message,  array $context = []);


}
