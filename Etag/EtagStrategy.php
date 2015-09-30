<?php

namespace EXSyst\Component\Rest\Etag;

final class EtagStrategy
{
    const PREFER_STRONG = 0;
    const DONT_CARE = 1;
    const PREFER_WEAK = 2;

    private function __construct()
    {
    }
}
