<?php

namespace Merlot\Entry\Types;

use Merlot\Controllers\LiteraryTaxonomy as LiteraryTechniqueController;
use Merlot\Controllers\Collection as CollectionController;
use Merlot\Routing\Routes;
use Merlot\App;

class LiteraryTechnique extends Type {

	public function name() {

		return 'literary_technique';
	}

	public function path() {

		return '_literary-techniques';
	}

	public function routes() {

		$this->router->get( 'writing/techniques/{name}', LiteraryTechniqueController::class );

		$this->router->get( 'writing/techniques', CollectionController::class );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' ) . '/writing/techniques';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
