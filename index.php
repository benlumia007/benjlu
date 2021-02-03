<?php

require_once( 'vendor/autoload.php' );


/* === Application === */

date_default_timezone_set( 'America/Chicago' );

define( 'NOVA_DIR', __DIR__ );

$merlot = new \Merlot\Core\Application();

$config = require_once( 'config.php' );

$merlot->instance( 'path', NOVA_DIR );
$merlot->instance( 'uri', $config['uri'] );
$merlot->instance( 'uri/relative', parse_url( $merlot->uri, PHP_URL_PATH ) );
$merlot->instance( 'routes', new \Merlot\Routing\Routes() );
$merlot->singleton( 'cache', function() {
	return new \Merlot\Tools\Collection();
} );
$merlot->instance( 'config/entry', require_once( $merlot->path . '/config/entry.php' ) );
$merlot->instance( 'path/content', 'user/content' );
$merlot->singleton( 'template/engine', \Merlot\Template\Engine\Engine::class );
$merlot->singleton( 'content/types', function() {
	return new \Merlot\Entry\Types();
} );

$merlot->instance( 'cache/meta', [ 'date', 'category', 'era', 'slug' ] );

$merlot->singleton( 'mix', function( $app ) {

	$file = "{$app->path}/public/mix-manifest.json";

	return file_exists( $file ) ? json_decode( file_get_contents( $file ), true ) : null;
} );

$merlot->singleton( 'request', \Merlot\Http\Request::class );

$merlot->proxy( \Merlot\Proxies\Engine::class, '\Merlot\Engine' );
$merlot->proxy( \Merlot\Proxies\ContentTypes::class, '\Merlot\ContentTypes' );

$merlot->boot();

/* === Routes === */

$merlot->routes->get( 'feed', \Merlot\Controllers\Feed::class, 'top' );

$merlot->routes->get( 'page/{number}', \Merlot\Controllers\Home::class, 'top' );

\Merlot\ContentTypes::add( 'post', new \Merlot\Entry\Types\Post( $merlot->routes ) );

\Merlot\ContentTypes::add( 'category', new \Merlot\Entry\Types\Category( $merlot->routes ) );

\Merlot\ContentTypes::add( 'era', new \Merlot\Entry\Types\Era( $merlot->routes ) );

\Merlot\ContentTypes::add( 'author', new \Merlot\Entry\Types\Author( $merlot->routes ) );

\Merlot\ContentTypes::add( 'literature', new \Merlot\Entry\Types\Literature( $merlot->routes ) );

\Merlot\ContentTypes::add( 'page', new \Merlot\Entry\Types\Page( $merlot->routes ) );

\Merlot\ContentTypes::registerRoutes();

$merlot->routes->get( '/', \Merlot\Controllers\Home::class );

/* === Launch === */

if ( isset( $_GET['bust-cache'] ) ) {

	if ( 'all' === $_GET['bust-cache'] ) {

		$files = glob( $merlot->resolve( 'path' ) . "/user/cache/content/*.json" );

		foreach ( $files as $filename ) {
			unlink( $filename );
		}
	} else {
		$path = $merlot->resolve( 'path' ) . '/user/cache';

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
$current = $merlot->routes->current();