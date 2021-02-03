<?php

namespace Merlot\Entry\Types;

use Merlot\Controllers\Author as AuthorController;
use Merlot\Controllers\Collection as CollectionController;
use Merlot\Routing\Routes;
use Merlot\App;

class Author extends Type {

	public function name() {

		return 'author';
	}

	public function path() {

		return '_users';
	}

	public function routes() {

	//	$this->router->get( 'authors/{name}/page/{number}', AuthorController::class, 'top' );

	//	$this->router->get( 'authors/{name}', AuthorController::class );

	//	$this->router->get( 'authors', CollectionController::class );
	}

	public function uri( $path = '' ) {

		if ( $path ) {
			$parts = explode( '.', $path );

			if ( 2 === count( $parts ) ) {
				$path = $parts[1];
			}
		}

		$uri = App::resolve( 'uri/relative' ) . '/authors';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
