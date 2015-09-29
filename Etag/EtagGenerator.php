<?php

namespace EXSyst\Component\Rest\Etag;

class EtagGenerator
{
    const VALUE_SEPARATOR = '/';

    /**
     * @param mixed $value
     *
     * @return string|false
     */
    public function generate($value)
    {
        if (is_scalar($value)) {
            return $this->hash($value);
        } elseif (is_array($value)) {
            return $this->hash(
                $this->generateForArray($value)
            );
        } elseif ($value instanceof EtaggableInterface) {
            return $this->hash($value->getEtag());
        }

        return false;
    }

    /**
     * @param array $array
     *
     * @return string
     */
    private function generateForArray(array $array)
    {
        $return = '';
        foreach ($array as $k => $v) {
            $return .= $this->generate($k).self::VALUE_SEPARATOR.$this->generate($v);
            $return .= self::VALUE_SEPARATOR.self::VALUE_SEPARATOR; // Double separator at the end of a pair
        }

        return $return;
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
