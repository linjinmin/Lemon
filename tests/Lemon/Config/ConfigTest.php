<?php

namespace Lemon\Tests\Config;

use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    const CONFIG_FILE_PATH = __DIR__.'/../../../src/Lemon/Config/Config.php';

    public function testNotEmpty()
    {
        $this->assertFileExists(static::CONFIG_FILE_PATH);
        $array = include static::CONFIG_FILE_PATH;
        $this->assertNotEmpty($array);
    }
}