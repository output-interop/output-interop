<?php

/**
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace Interop\Output;

use Interop\Output\Exception\TemplateNotFound;

/**
 * Describes the Engine for driving HTML output
 */
interface Engine
{
	/**
	 * Returns the current Context
	 *
	 * This MAY be a collection of contexts, but must implement the Context Interface
	 *
	 * @return Context
	 */
	public function context();

	/**
	 * Use the given context as the new context
	 *
	 * @param Context $context The context to use
	 */
	public function useContext(Context $context);

	/**
	 * Returns the current Factory in use
	 *
	 * @return TemplateFactory
	 */
	public function templateFactory();

	/**
	 * Use the given TemplateFactory
	 *
	 * @param TemplateFactory $templateFactory The TemplateFactory to use
	 */
	public function useTemplateFactory(TemplateFactory $templateFactory);

	/**
	 * Returns the rendered template
	 *
	 * @param string        $template The name of the template to use
	 * @param Context|array $data     The data to use in rendering the template
	 *
	 * @throws TemplateNotFound When the template cannot be found
	 *
	 * @return string
	 */
	public function render($template, $data);
}

