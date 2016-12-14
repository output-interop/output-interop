<?php

/**
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace Interop\Output\Context;

/**
 * Describes a Collection of Contexts
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
	 * @return bool
	 */
	public function has(Context $context);
}