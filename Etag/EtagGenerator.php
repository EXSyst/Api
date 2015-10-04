<?php

namespace EXSyst\Component\Rest\Etag;

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
        list($etag, $strategy) = $this->processField($value, $strategy);
        if ($strategy === EtagStrategy::PREFER_WEAK) {
            $etag->setWeak(true);
        }

        return $etag;
    }

    /**
     * @param mixed $value
     * @param int   $strategy
     *
     * @return array|null
     */
    private function processField($value, $strategy)
    {
        if ($value instanceof Etag) {
            return [$value, $strategy];
        } elseif (is_scalar($value)) {
            return [new Etag($this->hash($value)), $strategy];
        } elseif (is_array($value)) {
            $newValue = '';
            $newStrategy = $strategy;
            $weak = false;
            foreach ($value as $k => $v) {
                list($etag, $tempStrategy) = $this->processField($v, $strategy);
                $newStrategy = $this->compareStrategies($tempStrategy, $newStrategy);

                $weak = $weak || $etag->isWeak();
                $newValue .= $this->hash(
                    $this->hash($k).self::VALUE_SEPARATOR.$this->hash($etag->getValue())
                );
            }
        } elseif ($value instanceof EtaggableInterface) {
            if ($value instanceof ExtendedEtaggableInterface) {
                if ($strategy === EtagStrategy::DONT_CARE &&
                    (!$value->supportsStrongEtag() || $value->prefersWeakEtag())) {
                    $strategy = EtagStrategy::PREFER_WEAK;
                } elseif ($strategy === EtagStrategy::PREFER_STRONG && !$value->supportsStrongEtag()) {
                    $strategy = EtagStrategy::PREFER_WEAK;
                }
            }
            $value = $value->getEtag($strategy);
            if (!($value instanceof Etag)) {
                $value = new Etag($value);
            }

            return [$value, $strategy];
        }
    }

    /**
     * @param int $a
     * @param int $b
     *
     * @return int
     */
    private function compareStrategies($a, $b)
    {
        if ($b === EtagStrategy::DONT_CARE) {
            return $a;
        } elseif ($a === EtagStrategy::DONT_CARE || $a === EtagStrategy::PREFER_STRONG) {
            return $b;
        } else {
            return $a;
        }
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
