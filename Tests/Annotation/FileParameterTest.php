<?php

namespace EXSyst\Component\Rest\Tests\Annotation;

use EXSyst\Component\Rest\Annotation\FileParameter;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class FileParameterTest extends BaseParameterTest
{
    public function getParameterClass()
    {
        return FileParameter::class;
    }

    public function getRequestBag()
    {
        return 'files';
    }
}
