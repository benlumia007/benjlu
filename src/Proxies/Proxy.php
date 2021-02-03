<?php
/**
 * Proxy class.
 *
 * This class is essentially a wrapper around the `Container` class that's
 * specific to the framework. This class is meant to be used as the single,
 * one-true instance of the framework. It's used to load up service providers
 * that interact with the container.
 *
 * @package   Merlot
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright Copyright 2021. Benjamin Lu
 * @link      https://github.com/benlumia007/benjlu
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Merlot\Proxies;

use Merlot\Contracts\Container\Container;

/**
 * Base static proxy class.
 *
 * @since  1.0.0
 * @access public
 */
class Proxy {

	/**
	 * The container object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Container
	 */
	protected static $container;

	/**
	 * Returns the name of the accessor for object registered in the container.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return string
	 */
	protected static function accessor() {

		return '';
	}

	/**
	 * Sets the container object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public static function setContainer( Container $container ) {

		static::$container = $container;
	}

	/**
	 * Returns the instance from the container.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return object
	 */
	protected static function instance() {

		return static::$container->resolve( static::accessor() );
	}

	/**
	 * Calls the requested method from the object registered with the
	 * container statically.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $method
	 * @param  array   $args
	 * @return mixed
	 */
	public static function __callStatic( $method, $args ) {

		$instance = static::instance();

		return $instance ? $instance->$method( ...$args ) : null;
	}
}
