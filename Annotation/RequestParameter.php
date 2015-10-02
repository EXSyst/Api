<?php

namespace EXSyst\Component\Rest\Annotation;

use Symfony\Component\HttpFoundation\Request;

/**
 * @Annotation
 * @Target({"METHOD", "ANNOTATION"})
 *
 * @author Ener-Getick <egetick@gmail.com>
 */
class RequestParameter extends AbstractParameter
{
    /**
     * {@inheritdoc}
     */
    public function exists(Request $request)
    {
        return $request->request->has($this->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(Request $request)
    {
        return $request->request->get($this->getName());
    }
}
