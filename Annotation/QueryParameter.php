<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Annotation;

use Symfony\Component\HttpFoundation\Request;

/**
 * @Annotation
 * @Target({"METHOD", "ANNOTATION"})
 *
 * @author Ener-Getick <egetick@gmail.com>
 */
class QueryParameter extends AbstractParameter
{
    /**
     * {@inheritdoc}
     */
    public function exists(Request $request)
    {
        return $request->query->has($this->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(Request $request)
    {
        return $request->query->get($this->getName());
    }
}
