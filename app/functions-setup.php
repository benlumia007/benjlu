<?php

use Benlumia007\Alembic\App;

function site_title() {
	if ( ! file_exists( 'user/content/_data/config.yml' ) ) {
		return;
	}
	$data = App::resolve( 'yaml' )->load( ( 'user/content/_data/config.yml' ) );

	if ( $data ) {
		$title = $data['title'];
		echo strip_tags( $title );
	}
}

function site_tagline() {
	if ( ! file_exists( 'user/content/_data/config.yml' ) ) {
		return;
	}

	$data = App::resolve( 'yaml' )->load( ( 'user/content/_data/config.yml' ) );

	if ($data) {
		$title = $data['tagline'];
		echo strip_tags( $title );
	}
}

function primary_navigation() {
	if ( ! file_exists( 'user/content/_data/config.yml' ) ) {
		return;
	}

	$data = App::resolve( 'yaml' )->load( ( 'user/content/_data/config.yml' ) );

	if ( $data ) {
		foreach ($data['primary'] as $name => $title ) { ?>
			<li class="menu-item"><a href="<?= e( uri( $title['url'] ) ) ?>"><?= e( $title['title'] ); ?></a></li>
		<?php }
	}
}
