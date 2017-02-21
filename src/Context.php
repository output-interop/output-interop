<?php

/**
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace Interop\Output;

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
	 * Provide data for a template
	 *
	 * @param Template $template
	 *
	 * @return array
	 */
	public function provide(Template $template);
}
