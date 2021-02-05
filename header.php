<?php
/**
 * Benjlu ( header.php )
 *
 * @package   Benjlu
 * @copyright Copyright (C) 2021. Benjamin Lu
 * @license   GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://getbenonit.com )
 */
?>
<!doctype html>
<html>
    <head>
        <title>
            <?php
                $route = Benlumia007\Alembic\App::resolve( 'routes' )->currentRoute();
                $paged = '';
                $title_tag = 'p';

                if ( false !== strpos( $route, 'page/{number}' ) ) {
                    $p = explode( '/', Benlumia007\Alembic\App::resolve( 'request' )->uri() );
                    $paged = ': Page ' . e( array_pop( $p ) );
                }

                if ( '/' === $route || 'page/{number}' === $route ) {
                    echo ! empty( $title ) ? e( $title ) . $paged : 'Benjamin Lu';
                    $title_tag = 'h1';
                } else {
                    echo ! empty( $title ) ? e( $title ) . $paged . ' &mdash; Benjamin Lu' : 'Benjamin Lu';
                }
            ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= e( asset( 'css/screen.css' ) ) ?>" />
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Merriweather:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">
    </head>
<body>
<section id="container" class="site-container">
	<header id="header" class="site-header">
		<div class="site-branding">
            <h1 class="site-title"><a href="<?= e( uri() ) ?>"><?= e( 'Benjamin Lu' ); ?></a></h1>
            <h3 class="site-description"><?= e( 'Web Developer' ); ?></h3>
		</div>
        <nav id="primary" class="menu-primary">
            <button class="menu-toggle" aria-conrol="primary-menu" aria-expanded="false"><?= e( 'Menu' ); ?></button>
            <ul class="menu-items">
                <li class="menu-item"><a href="about-me"><?= e( 'About Me' ); ?></a></li>
                <li class="menu-item"><a href="portfolio"><?= e( 'Portfolio' ); ?></a></li>
                <li class="menu-item"><a href="hostings"><?= e( 'Hostings' ); ?></a></li>
            </ul>
        </nav>
	</header>