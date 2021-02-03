<?php \Merlot\Engine::view( 'header', [], [ 'title' => $title, 'query' => ! empty( $query ) ? $query : false ] )->display() ?>

	<div class="app-content">
		<main class="app-main">

			<?php foreach ( $entries->all() as $entry ) : ?>

				<?php \Merlot\Engine::view( 'entry-single', [ $entry->type()->name() ], [ 'entry' => $entry ] )->display() ?>

			<?php endforeach ?>

		</main>
	</div>

<?php \Merlot\Engine::view( 'footer' )->display() ?>
