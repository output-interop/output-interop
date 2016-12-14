<?php

/**
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

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