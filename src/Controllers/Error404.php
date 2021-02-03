<?php

namespace Merlot\Controllers;

use Merlot\Entry\Entries;
use Merlot\Entry\Locator;
//use Merlot\Entry\Types\Post;
use Merlot\Engine;

use Merlot\App;

class Error404 {

	protected $slug;
	protected $path = '_posts';

	protected $type;

	protected $params = [];

	public function __invoke( array $params = [] ) {

		http_response_code( 404 );

		$this->params = (array) $params;

		$entries = $this->entries();

		$all = $entries->all();
		$entry = array_shift( $all );

		Engine::view( 'page', [], [
			'title'   => $entry ? $entry->title() : 'Not Found',
			'page'    => 1,
			'entries' => $entries
		] )->display();
	}

	protected function entries() {

		$locator = new Locator( '_error' );

		return new Entries( $locator, [ 'slug' => '404' ] );
	}
}
