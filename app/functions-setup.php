<?php

function site_title() {
	$yaml = new Benlumia007\Alembic\Tools\Yaml();
	$data = $yaml->load( ( file_exists( 'config.yml' ) ) ? 'config.yml' : '' );
	$title = $data['title'];
	echo $title;
}

function site_tagline() {
	$yaml = new Benlumia007\Alembic\Tools\Yaml();
	$data = $yaml->load( ( file_exists( 'config.yml' ) ) ? 'config.yml' : '' );
	$title = $data['tagline'];
	echo $title;	
}

function primary_navigation() {
	$yaml = new Benlumia007\Alembic\Tools\Yaml();
	$data = $yaml->load( ( file_exists( 'config.yml' ) ) ? 'config.yml' : '' );
	foreach ($data['primary'] as $name => $title ) { ?>
		<li class="menu-item"><a href="<?= e( uri( $title['url'] ) ) ?>"><?= e( $title['title'] ); ?></a></li>
	<?php }
}
