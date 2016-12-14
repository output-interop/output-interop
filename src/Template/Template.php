<?php

/**
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

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