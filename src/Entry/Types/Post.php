<?php
/**
 * Application class.
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
namespace Merlot\Entry\Types;

use Merlot\Controllers\Post as PostController;
use Merlot\Controllers\PostDayArchive;
use Merlot\Controllers\PostMonthArchive;
use Merlot\Controllers\PostYearArchive;
use Merlot\Routing\Routes;
use Merlot\App;

class Post extends Type {

	public function name() {

		return 'post';
	}

	public function path() {

		return '_posts';
	}

	public function routes() {

		$this->router->get( 'archives/{year}/{month}/{day}/{name}', PostController::class );
		$this->router->get( 'archives/{year}/{month}/{day}', PostDayArchive::class );
		$this->router->get( 'archives/{year}/{month}', PostMonthArchive::class );
		$this->router->get( 'archives/{year}', PostYearArchive::class );

	//	$this->router->get( 'posts/{name}', Controller::class );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri' ) . '/archives';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
