PHP Output Rendering Interoperability
=====================================

*output-interop* tries to identify and standardize features in *output* renderers (Twig, Smarty, PHP, Blade, FoilPHP)
to achieve interoperability.

Through discussions and trials, we try to create a standard, made of common interfaces but also recommendations.

If PHP projects that use one of these renderers and begin to adopt these common standards, then PHP applications and
projects that use those renderers can depend on the common interfaces instead of specific implementations. This facilitates
a high-level of interoperability and flexibility that allows users to consume *any* renderer implementation that can be
adapted to these interfaces.

The work done in this project is not officially endorsed by the PHP-FIG, but it is being worked on by other good developers.
We adhere to the spirit and ideals of the PHP-FIG, and hope this project will pave the way for one or more future PSRs.

Installation
------------

You can install this package thorugh Composer:

`composer require output-interop/output-interop`

The packages adhers to the [SemVer](http://semver.org) specification, and there will be full backward compatibility
between minor versions.
