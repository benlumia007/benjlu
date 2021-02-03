<?php

namespace Merlot\Controllers;

use Merlot\Entry\Entries;
use Merlot\Entry\Locator;
use Merlot\Engine;

class Home {

	protected $params;

	public function __invoke( array $params = [] ) {

		$this->params = $params;

		Engine::view( 'home', [], [
			'page'    => isset( $this->params['number'] ) ? intval( $this->params['number'] ) : 1,
			'entries' => $this->entries(),
			'title'   => 'Benjamin Lu'
		] )->display();
	}

	protected function entries() {

		$path = '_posts';

		$locator = new Locator( $path );

		$per_page = posts_per_page();
		$current  = isset( $this->params['number'] ) ? intval( $this->params['number'] ) : 1;

		$args = [
			'number' => $per_page,
			'offset' => $per_page * ( $current - 1 ),
			'order'  => 'desc',
		//	'orderby' => 'date'
		];

		return new Entries( $locator, $args );
	}
}