<?php

namespace EXSyst\Component\Rest\Etag;

use EXSyst\Component\Rest\Etag\EtaggableInterface;

class EtagGenerator
{
    const HASH_SEPERATOR = '/';
    const CONTAINER_OPENING = '(';
    const CONTAINER_CLOSING = ')';

    public function getEtag($value)
    {
        if (is_string($value) or is_numeric($value)) {
            return md5($value);
        }
        if (is_array($value)) {
            $return = self::CONTAINER_OPENING;
            foreach ($value as $row) {
                $return .= $this->getEtag($row).self::HASH_SEPERATOR;
            }
            $return .= self::CONTAINER_CLOSING;

            return md5($return);
        } elseif ($value instanceof EtaggableInterface) {
            return md5($value->getEtag());
        } elseif ($value === null) {
            return md5('null');
        } else {
            throw new \LogicException('not implemented');
        }
    }
}
