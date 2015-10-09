<?php

/*
 * This file is part of the Rest package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Rest\Etag;

/**
 * @author Exter-n <exter-n@exter-n.fr>
 */
class Etag
{
    /**
     * @var string
     */
    private $value;
    /**
     * @var bool
     */
    private $weak;

    /**
     * @param string $value
     * @param bool   $weak
     */
    public function __construct($value, $weak = false)
    {
        $this->value = (string) $value;
        $this->weak = !!$weak;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param bool $weak
     *
     * @return $this
     */
    public function setWeak($weak)
    {
        $this->weak = !!$weak;

        return $this;
    }

    /**
     * @return bool
     */
    public function isWeak()
    {
        return $this->weak;
    }

    /**
     * @return bool
     */
    public function getWeak()
    {
        return $this->weak;
    }
}
