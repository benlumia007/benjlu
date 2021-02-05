<?php
/**
 * Benjlu ( functions.php )
 *
 * @package   Benjlu
 * @copyright Copyright (C) 2021. Benjamin Lu
 * @license   GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://getbenonit.com )
 */

require_once( 'vendor/autoload.php' );

define( 'BENJLU_DIR', __DIR__ );

$benjlu = new Benlumia007\Alembic\Core\Framework();

$config = require_once( 'app/functions-config.php' );



$benjlu->instance( 'path', BENJLU_DIR );
$benjlu->instance( 'uri', $config['uri'] );
$benjlu->instance( 'uri/relative', parse_url( $benjlu->uri, PHP_URL_PATH ) );
$benjlu->instance( 'routes', new Benlumia007\Alembic\Routing\Routes() );
$benjlu->singleton( 'cache', function() { return new Benlumia007\Alembic\Tools\Collection(); } );
$benjlu->instance( 'config/entry', require_once( $benjlu->path . '/app/functions-entry.php' ) );
$benjlu->instance( 'path/content', 'user/content' );
$benjlu->singleton( 'template/engine', Benlumia007\Alembic\Template\Engine\Engine::class );
$benjlu->singleton( 'content/types', function() { return new Benlumia007\Alembic\Entry\Types(); } );
$benjlu->instance( 'cache/meta', [ 'date', 'category', 'era', 'slug' ] );
$benjlu->singleton( 'mix', function( $app ) { $file = "{$app->path}/public/mix-manifest.json"; return file_exists( $file ) ? json_decode( file_get_contents( $file ), true ) : null; } );
$benjlu->singleton( 'request', Benlumia007\Alembic\Http\Request::class );
$benjlu->proxy( Benlumia007\Alembic\Proxies\Engine::class, 'Benlumia007\Alembic\Engine' );
$benjlu->proxy( Benlumia007\Alembic\Proxies\ContentTypes::class, 'Benlumia007\Alembic\ContentTypes' );
$benjlu->boot();

$benjlu->routes->get( 'feed', Benlumia007\Alembic\Controllers\Feed::class, 'top' );
$benjlu->routes->get( 'page/{number}', Benlumia007\Alembic\Controllers\Home::class, 'top' );

Benlumia007\Alembic\ContentTypes::add( 'post', new Benlumia007\Alembic\Entry\Types\Post( $benjlu->routes ) );
Benlumia007\Alembic\ContentTypes::add( 'category', new Benlumia007\Alembic\Entry\Types\Category( $benjlu->routes ) );
Benlumia007\Alembic\ContentTypes::add( 'era', new Benlumia007\Alembic\Entry\Types\Era( $benjlu->routes ) );
Benlumia007\Alembic\ContentTypes::add( 'author', new Benlumia007\Alembic\Entry\Types\Author( $benjlu->routes ) );
Benlumia007\Alembic\ContentTypes::add( 'literature', new Benlumia007\Alembic\Entry\Types\Literature( $benjlu->routes ) );
Benlumia007\Alembic\ContentTypes::add( 'page', new Benlumia007\Alembic\Entry\Types\Page( $benjlu->routes ) );
Benlumia007\Alembic\ContentTypes::registerRoutes();
$benjlu->routes->get( '/', Benlumia007\Alembic\Controllers\Home::class );

if ( isset( $_GET['bust-cache'] ) ) {

	if ( 'all' === $_GET['bust-cache'] ) {

		$files = glob( $benjlu->resolve( 'path' ) . "/user/cache/content/*.json" );

		foreach ( $files as $filename ) {
			unlink( $filename );
		}
	} else {
		$path = $benjlu->resolve( 'path' ) . '/user/cache';

		$name = preg_replace( '/[^A-Za-z0-9\/_-]/i', '', $_GET['bust-cache'] );

		if ( file_exists( "{$path}/{$name}.json" ) ) {
			unlink( "{$path}/{$name}.json" );
		}
	}
}

// Check if ob_gzhandler already loaded
if ( ini_get( 'output_handler' ) !== 'ob_gzhandler' ) {
	if ( extension_loaded( 'zlib' ) ) {
		if ( ! ob_start( 'ob_gzhandler' ) ) {
			ob_start();
		}
	}
}

// Launch the current controller.
$current = $benjlu->routes->current();