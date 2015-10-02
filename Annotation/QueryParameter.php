<?php

namespace EXSyst\Component\Rest\Annotation;

use Symfony\Component\HttpFoundation\Request;

/**
 * @Annotation
 * @Target({"METHOD", "ANNOTATION"})
 *
 * @author Ener-Getick <egetick@gmail.com>
 */
class QueryParameter extends AbstractParameter
{
    /**
     * {@inheritdoc}
     */
    public function exists(Request $request)
    {
        return $request->query->has($this->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(Request $request)
    {
        return $request->query->get($this->getName());
    }
}
