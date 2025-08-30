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
	 * Returns whether the template has data within this context
	 */
	public function accepts(string $name): bool;

	/**
	 * Provide data for a template
	 */
	public function provide(string $name): array;
}
