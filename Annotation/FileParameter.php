<?php

namespace EXSyst\Component\Rest\Annotation;

use Symfony\Component\HttpFoundation\Request;

/**
 * @Annotation
 * @Target({"METHOD", "ANNOTATION"})
 *
 * @author Ener-Getick <egetick@gmail.com>
 */
class FileParameter extends AbstractParameter
{
    /**
     * {@inheritdoc}
     */
    public function exists(Request $request)
    {
        return $request->files->has($this->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(Request $request)
    {
        return $request->files->get($this->getName());
    }
}
