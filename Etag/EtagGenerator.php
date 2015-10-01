<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Etag;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class EtagGenerator
{
    const VALUE_SEPARATOR = '/';

    /**
     * @param mixed $value
     * @param int   $strategy
     *
     * @return Etag|false
     */
    public function generate($value, $strategy = EtagStrategy::PREFER_STRONG)
    {
        if ($value instanceof Etag) {
            return $value;
        } elseif (is_scalar($value)) {
            return new Etag($value);
        } elseif (is_array($value)) {
            return $this->processArray($value, $strategy);
        } elseif ($value instanceof EtaggableInterface) {
            return $this->processEtaggableObject($value, $strategy);
        }

        return $etag;
    }

    /**
     * @param array $value
     * @param int   $strategy
     *
     * @return Etag
     */
    private function processArray(array $value, $strategy)
    {
        $newValue = '';
        $weak = false;
        foreach ($value as $k => $v) {
            $etag = $this->processField($v, $strategy);
            $weak = $weak || $etag->isWeak();
            $newValue .= $this->hash(
                $this->hash($k).self::VALUE_SEPARATOR.$this->hash($etag->getValue())
            );
        }

        return new Etag($newValue, $weak);
    }

    /**
     * @param EtaggableInterface $value
     * @param int                $strategy
     *
     * @return Etag
     */
    private function processEtaggableObject(EtaggableInterface $value, $strategy)
    {
        $value = $value->getEtag($strategy);
        if (!($value instanceof Etag)) {
            $value = new Etag($value, true);
        }

        return $value;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private function hash($string)
    {
        return md5($string);
    }
}
