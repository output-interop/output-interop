Output Rendering Interface
==========================

This document describes a common interface for Output rendering engines.

The goal set by `Engine` is to standardize how frameworks and libraries make use of an
engine to render templates and data (called contexts in the rest of this document).

The keywords "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD",
"SHOULD NOT", "RECOMMENDED", "MAY", and "OPTIONAL" in this document are to be
interpreted as described in [RFC 2119][].

The word `implementor` in this document is to be interpreted as someone
implementing the `Engine` interface in a dependency injection-related library or framework.
Users of dependency injection containers (DIC) are referred to as `user`.

[RFC 2119]: http://tools.ietf.org/html/rfc2119

1. Specification
-----------------

From here forward, the namespace `Interop\Output` will be omitted when
referring to these interfaces.

### 1.1 Templates

Templates are responsible for coordinating the data and output for display 

`Template` exposes two methods `name` and `render`.

- `name` returns the name of the template as a string.

- `render` takes one mandatory parameter: a `Context` that may be
  applied to the template. A string SHOULD be returned, but null is acceptable.

### 1.2 Contexts

`Context` exposes two methods `accepts` and `provide` to check,
and/or obtain, the data that a context has based on the template. Contexts
hold data that MAY be available during the rendering process. Whether a 
template has access to the context data is up to the implementors to decide. 
Contexts MUST be able to answer whether they provide any data for a given template.

#### 1.2.1 Examples

This sections describes examples of contexts, that MAY be added to a Collection.
Engines are not required to implement these features to respect the Collection
There is no absolute defined type, but the basic idea is that "default" variables
should be considered a Generic context, or available to all templates.

##### 1.2.1.1 `Collection` Context

A collection of other types of contexts.

##### 1.2.1.2 `Generic` Context

Default or global variables available to all templates.

##### 1.2.1.3 `Regex` Context

Variables that are available to templates based on a regular expression.

##### 1.2.1.4 `Contains` Context

Variables that are available to templates that contain the given string.

### 1.3 Engine

The `Engine` exposes two methods: `context` and `render`.

- `context` takes no parameters. It MUST return a `Context`. This SHOULD
   be treated as the global context for all calls to `render`.
 
- `render` takes one mandatory parameter: the template name, and one
  optional parameter: an array of data or a `Context` object. The
  template name must be a string. It returns a string, which is the `Template`
  object with the applied context. It MUST throw a `TemplateNotFound`
  exception when the template cannot be found.

### 1.2 Exceptions

A call to the `render` method with a non-existing template should throw a 
[`Interop\Output\Exception\TemplateNotFound`](../src/Exception/TemplateNotFound.php).

2. Package
----------

The interfaces and classes described as well as relevant exceptions are provided as part of the
[output-interop/output-interop](https://packagist.org/packages/output-interop/output-interop) package.

3. Interfaces
-------------

### 3.1 `Interop\Output\Context`

```php
<?php
namespace Interop\Output;

/**
 * Describes a Context object
 */
interface Context
{
	/**
	 * Returns whether the template has data within this context
	 *
	 * @param string $name The template name
	 *
	 * @return boolean True if there is data for the template, false otherwise
	 */
	public function accepts(string $name): bool;

	/**
	 * Returns the available data for the template
	 *
	 * @param string $name The template name
	 *
	 * @return array
	 */
	public function provide(string $name): array;
}
```

### 3.2 `Interop\Output\Template`

```php
<?php
namespace Interop\Output;

/**
 * Describes the interface of a Template renderer
 */
interface Template
{
	/**
	 * Returns the name of this Template
	 *
	 * @return string
	 */
	public function name(): string;

	/**
	 * Renders the context data into the template
	 *
	 * @param Context $context
	 *
	 * @return string
	 */
	public function render(Context $context): string;
}
```

### 3.3 `Interop\Output\Engine`

```php
<?php
namespace Interop\Output;

use Interop\Output\Exception\TemplateNotFound;

/**
 * Describes the Engine for driving HTML output
 */
interface Engine
{
	/**
	 * Returns the rendered template
	 *
	 * @param string         $templateName The name of the template to use
	 * @param Context|array  $data         The data to use in rendering the template
	 *
	 * @throws TemplateNotFound When the template cannot be found
	 *
	 * @return string
	 */
	public function render(string $templateName, Context|array $context = []): string;
}
```

### 3.5 `Interop\Output\Exception\TemplateNotFound`

```php
<?php
namespace Interop\Output\Exception;

/**
 * Describes the TemplateNotFound Exception
 */
interface TemplateNotFound
{
}
```