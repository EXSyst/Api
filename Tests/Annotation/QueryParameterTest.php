<?php

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
