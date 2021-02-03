<?php \Merlot\Engine::view( 'header' )->display() ?>

	<div class="app-content">
		<main class="app-main">

			<?php foreach ( $entries->all() as $entry ) : ?>

				<?php \Merlot\Engine::view( 'entry', [ $entry->type()->name() ], [ 'entry' => $entry ] )->display() ?>

			<?php endforeach ?>

			<?php \Merlot\Engine::view( 'pagination', [], $data )->display() ?>

		</main>
	</div>

<?php \Merlot\Engine::view( 'footer' )->display() ?>
