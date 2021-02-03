<?php

namespace Merlot\Entry\Types;

use Merlot\Controllers\Page as Controller;
use Merlot\Routing\Routes;
use Merlot\App;

class Page extends Type {

	public function name() {

		return 'page';
	}

	public function path() {

		return '';
	}

	public function routes() {

		$this->router->get( '{name}', Controller::class );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' );

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
