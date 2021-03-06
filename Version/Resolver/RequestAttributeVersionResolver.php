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
class RequestAttributeVersionResolver implements VersionResolverInterface
{
    /**
     * @var string
     */
    private $attributeName;

    /**
     * @param string $attributeName
     */
    public function __construct($attributeName = 'version')
    {
        $this->attributeName = $attributeName;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(Request $request)
    {
        if (!$request->attributes->has($this->attributeName)) {
            return false;
        }

        return $request->attributes->get($this->attributeName);
    }
}
