<?php

declare(strict_types=1);

namespace Symdoc\Tests;

use Symdoc\Globals;
use PHPUnit\Framework\TestCase;

class GlobalsTest extends TestCase
{
    public function testGlobals()
    {
        $this->assertEquals("/../version", Globals::SYMDOC_VERSION);
    }
}
