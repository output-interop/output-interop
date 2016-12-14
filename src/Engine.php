<?php

/**
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

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
	 * @return Collection
	 */
	public function contexts();

	/**
	 * Returns the current Factory in use
	 *
	 * @return Factory
	 */
	public function factory();

	/**
	 * Adds the given context to the context collection
	 *
	 * @param Context $context
	 */
	public function useContext(Context $context);

	/**
	 * Adds the given data as a global context to the context collection
	 *
	 * @param array $data
	 */
	public function useData(array $data);

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

