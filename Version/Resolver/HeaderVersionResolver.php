<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Version\Resolver;

use EXSyst\Component\Api\Version\VersionResolverInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class HeaderVersionResolver implements VersionResolverInterface
{
    /**
     * @var string
     */
    private $headerName;

    /**
     * @param string $headerName
     */
    public function __construct($headerName = 'X-Accept-Version')
    {
        $this->headerName = $headerName;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(Request $request)
    {
        if (!$request->headers->has($this->headerName)) {
            return false;
        }

        return $request->headers->get($this->headerName);
    }
}
