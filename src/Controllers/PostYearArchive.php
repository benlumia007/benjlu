<?php

namespace Merlot\Controllers;

use Merlot\App;
use Merlot\Entry\Entries;
use Merlot\Entry\Locator;
use Merlot\Engine;
use Merlot\ContentTypes;

class PostYearArchive {

	protected $params = [];

	public function __invoke( array $params = [] ) {

		$this->params = (array) $params;

		$path    = ContentTypes::get( 'post' )->path();
		$locator = new Locator( $path );

		//$terms = ( new Entries( $locator, [ 'slug' => $this->slug ] ) )->all();

		Engine::view( 'archive', [], [
			'page'    => 1,
			'entries' => $this->entries(),
			'title'   => isset( $params['year'] ) ? $params['year'] : 'Not Found'
		//	'query'   => array_shift( $terms )
		] )->display();
	}

	protected function entries() {

		$path = ContentTypes::get( 'post' )->path();

		$locator = new Locator( $path );

		$per_page = PHP_INT_MAX;//posts_per_page();
		$current  = intval( trim( preg_replace( '/.*?page\/([\d]).*?/i', '$1', App::resolve( 'request' )->uri() ), '/' ) );
		$current  = $current ?: 1;

		$args = [
			'number'     => $per_page,
			'offset'     => $per_page * ( $current - 1 ),
			'order'      => 'desc',
			'year'    => abs( intval( $this->params['year'] ) )
		];

		return new Entries( $locator, $args );
	}
}
