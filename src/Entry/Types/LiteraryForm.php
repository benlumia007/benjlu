<?php

namespace Merlot\Entry\Types;

use Merlot\Controllers\LiteraryTaxonomy as LiteraryFormController;
use Merlot\Controllers\Collection as CollectionController;
use Merlot\Routing\Routes;
use Merlot\App;

class LiteraryForm extends Type {

	public function name() {

		return 'literary_form';
	}

	public function path() {

		return '_literary-forms';
	}

	public function routes() {

		$this->router->get( 'writing/forms/{name}', LiteraryFormController::class );

		$this->router->get( 'writing/forms', CollectionController::class );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' ) . '/writing/forms';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
