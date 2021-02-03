<?php

namespace Merlot\Entry;

use Merlot\Entry\Types\Type;
use Merlot\Tools\Collection;

class Types extends Collection {

	public function add( $name, $type ) {

		if ( ! $type instanceof Type ) {
			return;
		}

		parent::add( $name, $type );
	}

	public function registerRoutes() {

		foreach ( $this->all() as $type ) {
			$type->routes();
		}
	}
}
