<?php

namespace EXSyst\Component\Api\Version;

use Composer\Semver\Semver;

/**
 * Matches the versions corresponding to a version constraint.
 */
class VersionMatcher
{
    /**
     * @var array
     */
    private $versions;

    /**
     * @param array $versions
     */
    public function __construct(array $versions)
    {
        $this->versions = Semver::rsort($versions);
    }

    /**
     * @param string $constraint See {@link https://getcomposer.org/doc/articles/versions.md}
     * @param bool   $transform  if true, will transform the simple constraint (v1, 1.2, ...) in a constraint with an interval (^v1, ^1.2, ...)
     *
     * @return array ordered from the last release to the first
     */
    public function match($constraint, $transform = true)
    {
        if($transform && preg_match('/^v?[0-9]+(\.[0-9]+)*$/', $constraint)) {
            $constraint = '^'.$constraint;
        }

        return Semver::satisfiedBy($this->versions, $constraint);
    }
}
