<?php

/**
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace Interop\Output;

/**
 * Describes the interface of a Template renderer
 */
interface Template
{
	/**
	 * Returns the name of this Template
	 */
	public function name(): string;

	/**
	 * Renders the context data into the template
	 */
	public function render(Context $context): string;
}