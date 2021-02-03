<?php

namespace Merlot\Entry\Types;

use Merlot\Controllers\Tag as TagController;
use Merlot\Controllers\Collection as CollectionController;
use Merlot\Routing\Routes;
use Merlot\App;

class Tag extends Type {

	public function name() {

		return 'tag';
	}

	public function path() {

		return '_tags';
	}

	public function routes() {

		$this->router->get( 'tags/{name}', TagController::class );

		$this->router->get( 'tags', CollectionController::class );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' ) . '/tags';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
