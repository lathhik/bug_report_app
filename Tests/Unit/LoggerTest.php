<?php

namespace Tests\Unit;

use App\Contracts\LoggerInterface;
use App\Exception\InvalidLogLevelArgumentException;
use App\Logger\Logger;
use PHPUnit\Framework\TestCase;
use App\Logger\LogLevel;
use App\Helpers\App;


class LoggerTest extends TestCase
{
    private $logger;

    /**
     * 
     */
    public function setUp()
    {
        $this->logger = new Logger;
        parent::setUp();
    }


    /**
     * 
     */
    public function testItImplementsTheLoggerInterface()
    {
        self::assertInstanceOf(LoggerInterface::class, new Logger);
    }


    /**
     *  test case whether log check the diffrent log file created or not
     */
    public function testItCanCreateDefferentTypeOfLogFile()
    {
        $application = new App;
        $this->logger->emergency('This is emergency log file');
        $this->logger->info('This is info log file');
        $this->logger->log(LogLevel::CRITICAL, 'Alert !! something wrong !');

        $filename = sprintf('%s/%s-%s.log', $application->getLogPath(), 'test', date('j.n.Y'));
        self::assertFileExists($filename);

        $log_file_content = file_get_contents($filename);
        self::assertStringContainsString('This is emergency log file', $log_file_content);
        self::assertStringContainsString('This is info log file', $log_file_content);
        self::assertStringContainsString(LogLevel::EMERGENCY, $log_file_content);

        unlink($filename);

        self::assertFileNotExists($filename);
    }

    public function testItThrowsInvalidLogLevelArgumentExceptionWhenGivenAwrongLevel()
    {
        self::expectException(InvalidLogLevelArgumentException::class);
        $this->logger->log('invalid', 'Testing invalid log level');
    }
}
