<?php

namespace EXSyst\Component\Rest\Etag;

class EtagGenerator
{
    const VALUE_SEPARATOR = '/';
    const CONTAINER_OPENING = '(';
    const CONTAINER_CLOSING = ')';

    /**
     * @param mixed $value
     *
     * @return string|false
     */
    public function generate($value)
    {
        if (is_scalar($value)) {
            return md5($value);
        } elseif (is_array($value)) {
            $return = self::CONTAINER_OPENING;
            foreach ($value as $k => $v) {
                $return .= $this->generate($k).self::VALUE_SEPARATOR.$this->generate($v);
                $return .= self::VALUE_SEPARATOR.self::VALUE_SEPARATOR; // Double separator at the end of a pair
            }
            $return .= self::CONTAINER_CLOSING;

            return md5($return);
        } elseif ($value instanceof EtaggableInterface) {
            return md5($value->getEtag());
        }

        return false;
    }
}
