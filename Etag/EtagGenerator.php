<?php

namespace EXSyst\Component\Rest\Etag;

use EXSyst\Component\Rest\Exception;

class EtagGenerator
{
    const VALUE_SEPARATOR = '/';
    const CONTAINER_OPENING = '(';
    const CONTAINER_CLOSING = ')';

    /**
     * @param mixed $value
     *
     * @throws Exception\LogicException when the value is not supported
     *
     * @return string
     */
    public function generate($value)
    {
        if (is_scalar($value)) {
            return md5($value);
        }
        if (is_array($value)) {
            $return = self::CONTAINER_OPENING;
            foreach ($value as $k => $v) {
                $return .= $this->generate($k).self::VALUE_SEPARATOR.$this->generate($v);
                $return .= self::VALUE_SEPARATOR.self::VALUE_SEPARATOR; // Double separator at the end of a pair
            }
            $return .= self::CONTAINER_CLOSING;

            return md5($return);
        } elseif ($value instanceof EtaggableInterface) {
            return md5($value->getEtag());
        } elseif ($value === null) {
            return md5('null');
        } else {
            throw new Exception\LogicException('This value can\'t be transformed in an etag. If it is an object, you must use EXSyst\Component\Rest\Etag\EtaggableInterface.');
        }
    }
}
