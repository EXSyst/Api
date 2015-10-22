<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Tests\Version;

use EXSyst\Component\Api\Version\VersionMatcher;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class VersionMatcherTest extends \PHPUnit_Framework_TestCase
{
    public function testMatch()
    {
        $matcher = new VersionMatcher([
            '3.4',
            '1.0',
            '2.3',
            '3.2',
            '2.5',
        ]);

        $this->assertEquals(['2.5', '2.3'], $matcher->match('v2'));
        $this->assertEquals([], $matcher->match('v2', false));
        $this->assertEquals(['2.3'], $matcher->match('v2.3', false));

        $this->assertEquals(['3.4'], $matcher->match('3.3'));
        $this->assertEquals(['3.4', '3.2', '1.0'], $matcher->match('^1|^3.2'));
    }
}
