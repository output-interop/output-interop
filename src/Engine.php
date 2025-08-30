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
	 * Returns the rendered template
	 *
	 * @throws TemplateNotFound When the template cannot be found
	 */
	public function render(string $template, Context|array $data): string;
}

