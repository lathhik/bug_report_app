<?php

declare(strict_types=1);

use App\Helpers\App;
use PHPUnit\Framework\TestCase;


class ApplicationTest extends TestCase
{
    /**
     * 
     */
    public function testItCanGetInstanceOfApplication()
    {
        self::assertInstanceOf(App::class, new App);
    }


    /**
     * 
     */
    public function testItCanGetDatasetFromAppClass()
    {
        $application = new App;
        $this->assertTrue($application->isRunningFromConsole());
        $this->assertSame('test', $application->getEnvironment());
        $this->assertNotNull($application->getLogPath());
        $this->assertInstanceOf(DateTime::class, $application->getServerTime());
    }
}
