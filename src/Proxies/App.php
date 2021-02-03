<?php
/**
 * App class.
 *
 * @package   Merlot
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright Copyright 2021. Benjamin Lu
 * @link      https://github.com/benlumia007/benjlu
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Merlot\Proxies;

/**
 * App static proxy class.
 *
 * @since  1.0.0
 * @access public
 */
class App extends Proxy {

	/**
	 * Returns the name of the accessor for object registered in the container.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return string
	 */
	protected static function accessor() {

		return 'app';
	}
}
