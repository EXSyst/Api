<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Tests\Version\Resolver;

use EXSyst\Component\Api\Version\Resolver\HeaderVersionResolver;
use EXSyst\Component\Api\Version\VersionResolverInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class ConstraintVersionResolverTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $this->assertInstanceof(
            VersionResolverInterface::class,
            new HeaderVersionResolver()
        );
    }

    public function testResolve()
    {
        $request = new Request();

        $resolver = new HeaderVersionResolver();
        $this->assertFalse($resolver->resolve($request));

        $request->headers->set('X-Accept-Version', 'v1');
        $this->assertEquals('v1', $resolver->resolve($request));
    }
}
