<?php

function site_title() {
	$data = Benlumia007\Alembic\App::resolve( 'yaml' )->load( ( file_exists( 'user/content/_data/config.yml' ) ) ? 'user/content/_data/config.yml' : '' );
	$title = $data['title'];
	echo strip_tags( $title );
}

function site_tagline() {
	$data = Benlumia007\Alembic\App::resolve( 'yaml' )->load( ( file_exists( 'user/content/_data/config.yml' ) ) ? 'user/content/_data/config.yml' : '' );
	$title = $data['tagline'];
	echo strip_tags( $title );
}

function primary_navigation() {
	$data = Benlumia007\Alembic\App::resolve( 'yaml' )->load( ( file_exists( 'user/content/_data/config.yml' ) ) ? 'user/content/_data/config.yml' : '' );
	foreach ($data['primary'] as $name => $title ) { ?>
		<li class="menu-item"><a href="<?= e( uri( $title['url'] ) ) ?>"><?= e( $title['title'] ); ?></a></li>
	<?php }
}
