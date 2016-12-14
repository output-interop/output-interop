Engine Interface
================

This document describes a common interface for Output rendering engines.

The goal set by `Engine` is to standardize how frameworks and libraries make use of a
engine to render templates and data (called contexts in the rest of this document).

The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD",
"SHOULD NOT", "RECOMMENDED", "MAY", and "OPTIONAL" in this document are to be
interpreted as described in [RFC 2119][].

The word `implementor` in this document is to be interpreted as someone
implementing the `Engine` interface in a depency injection-related library or framework.
Users of dependency injections containers (DIC) are refered to as `user`.

[RFC 2119]: http://tools.ietf.org/html/rfc2119

1. Specification
-----------------

From here forward, the namespace `Interop\Output` will be omitted when
referring to these interfaces.

### 1.1 Templates

Templates are responsible for coordinating the data and output for display 

`Template\Factory` exposes a way to load a Template.

`Template\Template` exposes methods for rendering the template, and 

### 1.2 Contexts

`Context\Context` exposes two methods `accepts` and `provide` to check,
and/or obtain, the data that a context has based on the template. Contexts
hold data that MAY be available during the rendering process. Whether or
not a template has access to the context data is up to the implementors
to decide. Contexts MUST be able to answer whether or not they provide
any data for a given template.

`Context\Collection` provides a representation of a group of contexts
that MAY be used to compose multiple contexts together. This is often
useful for when you have a global/default context, and regex contexts
that only show data on certain parts of the templates.

### 1.2 Engine

`Engine` coordinates between the `Template\Factory` and the `Context\Context`*[]: 
It MUST be able to return the current template  and context in use. It 
SHOULD use the factory to generate the `Template\Template` that will be used.

#### 1.1.2 Examples

This sections describes examples of contexts, that MAY be added to a Collection.
Engines are not required to implement these features to respect the Collection
There is
no absolute defined type, but the basic idea is that "default" variables
should be considered a Global context, or available to all

### 1.1 Templates

Templates represent the actual renderers. These are where the 

### 1.1 Engine

- The `Interop\Output\Engine` exposes multiple methods : `contexts`, `factory`, `useContext`, `render`.

- `contexts` takes no parameters. It MUST return a `Context\Collection`.

- `factory` takes no parameters. It MUST return a `Template\Factory`.
 
- `useContext` takes one mandatory parameter: a `Context` object. It does
  not return. The context should be added to the `Context\Collection`.
 
- `render` takes one mandatory parameter: the template name, and one
  optional parameter: an array of data. The template name must be a string.
  It returns the rendereed Template string. It must throw a `TemplateNotFound`
  exception when the template cannot be found.

### 1.2 Exceptions

A call to the `render` method with a non-existing template should throw a 
[`Interop\Output\Exception\TemplateNotFound`](../srcException/TemplateNotFound.php).


2. Package
----------

The interfaces and classes described as well as relevant exceptions are provided as part of the
[output-interop/output-interop](https://packagist.org/packages/output-interop/output-interop) package.

3. Interfaces
-------------

### 3.1 `Interop\Output\Context\Context`

```php
<?php
namespace Interop\Output\Context;

use Interop\Output\Template\Template;

/**
 * Describes a Context object
 */
interface Context
{
	/**
	 * Returns whether or not the template has data within this context
	 *
	 * @param Template $template
	 *
	 * @return boolean True if there is data for the template, false otherwise
	 */
	public function accepts(Template $template);

	/**
	 * Returns the available data for the template
	 *
	 * @param Template $template
	 *
	 * @return array
	 */
	public function provide(Template $template);
}
```

### 3.2 `Interop\Output\Context\Collection`

```php
<?php
namespace Interop\Output\Context;

/**
 * Describes a Collection of Context objects
 */
interface Collection
    extends Context
{
	/**
	 * Add a context to the collection
	 *
	 * @param Context $context
	 */
	public function add(Context $context);

	/**
	 * Remove a context from the collection
	 *
	 * @param Context $context
	 */
	public function remove(Context $context);

	/**
	 * Determine if the collection has the context
	 *
	 * @param Context $context
	 *
	 * @return bool
	 */
	public function has(Context $context);
}
```

### 3.2 `Interop\Output\Template\Template`

```php
<?php
namespace Interop\Output\Template;

use Interop\Output\Context\Context;

/**
 * Describes the interface of a Template renderer
 */
interface Template
{
	/**
	 * Returns the file that this Template will render
	 *
	 * @return string
	 */
	public function file();

	/**
	 * Renders the context data into the template
	 *
	 * @param Context $context
	 *
	 * @return string
	 */
	public function render(Context $context);
}
```

### 3.3 `Interop\Output\Template\Template`

```php
namespace Interop\Output\Template;

use Interop\Output\Exception\TemplateNotFound;

/**
 * Describes the interface for Template factories
 */
interface Factory
{
	/**
	 * Loads the given template
	 *
	 * @param string $template
	 *
	 * @throws TemplateNotFound When the template cannot be found
	 *
	 * @return Template
	 */
	public function load($template);
}
```

### 3.4 `Interop\Output\Engine`

```php
<?php
namespace Interop\Output;

use Interop\Output\Context\Collection;
use Interop\Output\Context\Context;
use Interop\Output\Exception\TemplateNotFound;
use Interop\Output\Template\Factory;

/**
 * Describes the Engine for driving HTML output
 */
interface Engine
{
	/**
	 * Returns the current Context Collection
	 *
	 * @return Context
	 */
	public function context();

	/**
	 * Returns the current Factory in use
	 *
	 * @return Factory
	 */
	public function factory();

	/**
	 * Returns the rendered template
	 *
	 * @param string $template The name of the template to use
	 * @param array  $data     The data to use in rendering the template
	 *
	 * @throws TemplateNotFound When the template cannot be found
	 *
	 * @return string
	 */
	public function render($template, array $data = []);
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