<?php

namespace Merlot\Controllers;

use Merlot\App;
use Merlot\Entry\Entries;
use Merlot\Entry\Locator;
use Merlot\Engine;
use Merlot\ContentTypes;

class Era {

	protected $params = [];

	public function __invoke( array $params = [] ) {

		$this->params = (array) $params;

		$this->slug = $this->params['name'];

		$path    = ContentTypes::get( 'era' )->path();
		$locator = new Locator( $path );
		$terms = ( new Entries( $locator, [ 'slug' => $this->slug ] ) )->all();

		Engine::view( 'taxonomy', [], [
			'page'    => 1,
			'entries' => $this->entries(),
			'query'   => array_shift( $terms )
		] )->display();
	}

	protected function entries() {

		//$path = '_posts';
		$path = ContentTypes::get( 'post' )->path();

		$locator = new Locator( $path );

		$per_page = PHP_INT_MAX;//posts_per_page();
		$current  = intval( trim( preg_replace( '/.*?page\/([\d]).*?/i', '$1', App::resolve( 'request' )->uri() ), '/' ) );
		$current  = $current ?: 1;

		$args = [
			'number'     => $per_page,
			'offset'     => $per_page * ( $current - 1 ),
			'order'      => 'desc',
			'meta_key'   => 'era',
			'meta_value' => $this->slug
		];

		return new Entries( $locator, $args );
	}
}
