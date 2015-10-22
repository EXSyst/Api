Upgrading
=========

This document will be updated to list important BC breaks and behavioral changes.

### Upgrading to v0.3
- ``AbstractVersionResolver`` is removed.
- the ``VersionResolverInterface``s now return the version they get. Their constructor signature was changed.
- a new ``VersionMatcher`` allows to match a constraint from a ``VersionResolverInterface`` to a list of pre-defined versions. 
