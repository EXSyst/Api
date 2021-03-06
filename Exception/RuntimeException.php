<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Exception;

/**
 * Exception thrown if an error which can only be found on runtime occurs.
 *
 * @author Ener-Getick <egetick@gmail.com>
 */
class RuntimeException extends \RuntimeException implements ExceptionInterface
{
}
