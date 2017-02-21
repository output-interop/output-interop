Output Rendering Interface
==========================

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

`TemplateFactory` exposes a way to load a Template.

`Template` exposes methods for rendering the template.

### 1.2 Contexts

`Context` exposes two methods `accepts` and `provide` to check,
and/or obtain, the data that a context has based on the template. Contexts
hold data that MAY be available during the rendering process. Whether or
not a template has access to the context data is up to the implementors
to decide. Contexts MUST be able to answer whether or not they provide
any data for a given template.

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

Variables that are available templates that contain the given string.

### 1.3 Engine

- The `Engine` exposes multiple methods : `context`, `factory`, `useContext`, `render`.

- `context` takes no parameters. It MUST return a `Context` object.

- `useContext` takes one mandatory parameter: the `Context` to use.
   This SHOULD replace the existing `Context` object.

- `factory` takes no parameters. It MUST return a `TemplateFactory`.
 
- `render` takes one mandatory parameter: the template name, and one
  optional parameter: an array of data or a `Context` object. The
  template name must be a string. It returns the rendered Template
  string. It must throw a `TemplateNotFound` exception when the template
  cannot be found.

### 1.2 Exceptions

A call to the `render` method with a non-existing template should throw a 
[`Interop\Output\Exception\TemplateNotFound`](../srcException/TemplateNotFound.php).

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

use Interop\Output\Template;

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

### 3.2 `Interop\Output\Template`

```php
<?php
namespace Interop\Output;

use Interop\Output\Context;

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

### 3.3 `Interop\Output\TemplateFactory`

```php
namespace Interop\Output;

use Interop\Output\Exception\TemplateNotFound;

/**
 * Describes the interface for Template factories
 */
interface TemplateFactory
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

use Interop\Output\Context;
use Interop\Output\Exception\TemplateNotFound;
use Interop\Output\TemplateFactory;

/**
 * Describes the Engine for driving HTML output
 */
interface Engine
{
	/**
	 * Returns the current Context
	 *
	 * @return Context
	 */
	public function context();

	/**
	 * Use the given context as the new context
	 *
	 * @param Context The context to use
	 */
	public function useContext(Context $context);
	
	/**
	 * Returns the current TemplateFactory in use
	 *
	 * @return TemplateFactory
	 */
	public function templateFactory();
	
	/**
	 * Use the given TemplateFactory
	 *
	 * @return TemplateFactory
	 */
	public function useTemplateFactory(TemplateFactory $templateFactory);

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