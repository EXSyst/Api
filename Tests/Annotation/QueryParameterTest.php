<?php

/*
 * This file is part of the Rest package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Rest\Tests\Annotation;

use EXSyst\Component\Rest\Annotation\QueryParameter;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class QueryParameterTest extends BaseParameterTest
{
    public function getParameterClass()
    {
        return QueryParameter::class;
    }

    public function getRequestBag()
    {
        return 'query';
    }
}
