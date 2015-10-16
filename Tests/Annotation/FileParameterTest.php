<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Tests\Annotation;

use EXSyst\Component\Api\Annotation\FileParameter;

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
