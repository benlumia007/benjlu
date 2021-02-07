<?php \Benlumia007\Alembic\Engine::view( 'header', [], [ 'title' => ! empty( $title ) ? $title : '' ] )->display() ?>
<section id="content" class="site-content">
	<div id="main" class="content-area">
		<article class="post">
		<?php if ( isset( $query ) ) : ?>
			<header class="entry-header">
				<h1 class="entry-title"><?= $query->title() ?></h1>

				<?php if ( $desc = $query->content() ) : ?>
					<div class="archive-header__description"><?= $desc ?></div>
				<?php endif ?>
			</header>
		<?php elseif ( isset( $title ) ) : ?>
			<header class="entry-header">
				<h1 class="entry-title"><?= e( $title ) ?></h1>
			</header>
		<?php endif ?>

		<ul>

			<?php foreach ( $entries->all() as $entry ) : ?>

				<li><a href="<?= $entry->uri() ?>"><?= $entry->title() ?></a>
					<?= $entry->excerpt() ?>
				</li>

			<?php endforeach ?>

		</ul>

		<?php Benlumia007\Alembic\Engine::view( 'public/views/pagination', [], $data )->display() ?>
		</article>
	</div>
</section>