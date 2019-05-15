<?php

declare(strict_types=1);

class DemoTest extends \PHPUnit\Framework\TestCase
{
    public function testEqualOne()
    {
        $this->assertEquals((new \ruoge3s\express\zto\Traces())->test(), 1);
    }
}