<?php

declare(strict_types=1);

namespace App\Helpers;

use Throwable;
use App\Exception\NotFoundException;

class Config
{
    /** 
     *  @param mixed $name
     *  @return mixed 
     */
    public static function getFileContent(string $filename): array
    {
        $file_content = [];
        try {
            $path = realpath(sprintf(__DIR__ . '/../Configs/%s.php', $filename));
            if (file_exists($path) && require $path) {
                $file_content = require $path;
            }
        } catch (Throwable $th) {
            throw new NotFoundException(
                sprintf('The specified file: %s was not found.', $filename),
                ['not found', 'data passed']

            );
        }

        return $file_content;
    }

    /**
     *  @param mixed $name
     */
    public static function get(string $filename, $key = null)
    {
        $file_content = self::getFileContent($filename);
        if ($key && $file_content)
            return $file_content[$key];
        return $file_content;
    }
}
