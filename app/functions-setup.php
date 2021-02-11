<?php

function site_title() {
	$data = Benlumia007\Alembic\Config\File::get_instance()->get_data();

	$title = $data['title'];
	echo strip_tags( $title );
}

function site_tagline() {
	$data = Benlumia007\Alembic\Config\File::get_instance()->get_data();
	$title = $data['tagline'];
	echo strip_tags( $title );
}

function primary_navigation() {
	$data = Benlumia007\Alembic\Config\File::get_instance()->get_data();
	foreach ($data['primary'] as $name => $title ) { ?>
		<li class="menu-item"><a href="<?= e( uri( $title['url'] ) ) ?>"><?= e( $title['title'] ); ?></a></li>
	<?php }
}