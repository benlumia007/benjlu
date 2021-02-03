<?php

namespace Merlot\Entry\Types;

use Merlot\Controllers\Category as CategoryController;
use Merlot\Controllers\Collection as CollectionController;
use Merlot\Routing\Routes;
use Merlot\App;

class Category extends Type {

	public function name() {

		return 'category';
	}

	public function path() {

		return '_topics';
	}

	public function routes() {

		$this->router->get( 'topics/{name}', CategoryController::class );

	//	$this->router->get( 'topics', CollectionController::class );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' ) . '/topics';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
