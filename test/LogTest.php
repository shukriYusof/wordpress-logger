<?php

declare(strict_types=1);

namespace Osky\WordpressPluginLogger;

use PHPUnit\Framework\TestCase;
use Osky\WordpressPluginLogger\Log;

final class LogTest extends TestCase
{
    public function testClassConstructor() 
    {
        $log = new Log(false);

        $log::info('test');

    }
}