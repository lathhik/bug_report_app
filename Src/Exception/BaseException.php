<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Throwable;

abstract class BaseException extends Exception
{

    protected $data = [];

    /**
     * @return mixed
     */
    public function __construct(string $message = "", array $data = [], int $code = 0, Throwable $previous = null)
    {
        $this->data = $data;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param $key
     * @param  $value
     * @return void
     */
    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }


    /**
     * @return array
     */
    public function getData(): array
    {
        if (count($this->data) == 0) {
            return $this->data;
        }

        return json_decode(json_encode($this->data), true);
    }
}
