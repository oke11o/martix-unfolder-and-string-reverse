<?php

namespace App\Tests\Unit;

use App\StringHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class StringHelperTest
 * @package App\Tests\Unit
 * @author Sergey Bevzenko <bevzenko.sergey@gmail.com>
 */
class StringHelperTest extends TestCase
{
    public function testRecursiveRevert()
    {
        $str = 'абв пg';
        $actual = StringHelper::recursiveRevert($str);

        $expected = 'gп вба';
        $this->assertEquals($expected, $actual);
    }
}
