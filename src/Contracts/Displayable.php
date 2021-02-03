<?php
/**
 * Displayable contract.
 *
 * Displayable classes should implement a `display()` method. The intent of this
 * method is to output an HTML string to the screen. This data should already be
 * escaped prior to being output.
 *
 * @package   Mint
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright Copyright (c) 2021, Benjamin Lu
 * @link      https://getbenonit.com
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Mint\Contracts;

/**
 * Displayable interface.
 *
 * @since  5.0.0
 * @access public
 */
interface Displayable {

	/**
	 * Prints the HTML string.
	 *
	 * @since  5.0.0
	 * @access public
	 * @return void
	 */
	public function display();
}