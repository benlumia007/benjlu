<?php Benlumia007\Alembic\Engine::view( 'header', [], [ 'title' => $title ] )->display() ?>
<section id="content" class="site-content">
	<main id="main" class="content-area">

		<?php foreach ( $entries->all() as $entry ) : ?>

			<article class="page">

				<header class="entry-header">
					<h1 class="entry-title"><?= widow( e( $entry->title() ) ) ?></h1>
				</header>

				<div class="entry-content">
					<?= $entry->content() ?>
				</div>

			</article>

			<?php
			$current_year = $current_month = $current_day = '';

			$posts = new Benlumia007\Alembic\Entry\Entries(
				new Benlumia007\Alembic\Entry\Locator(
					Benlumia007\Alembic\ContentTypes::get( 'post' )->path()
				),
				[
					'order' => 'desc',
					'number' => PHP_INT_MAX
				]
			); ?>

			<div class="clean-my-archives">

			<?php foreach ( $posts->all() as $post ) : ?>

				<?php
				$timestamp = is_numeric( $post->meta( 'date' ) ) ? $post->meta( 'date' ) : strtotime( $post->meta( 'date' ) );

				// Get the post's year and month. We need this to compare it with the previous post date.
				$year   = date( 'Y', $timestamp );
				$month  = date( 'm', $timestamp );
				$daynum = date( 'd', $timestamp );

				// If the current date doesn't match this post's date, we need extra formatting.
				if ( $current_year !== $year || $current_month !== $month ) :

					// Close the list if this isn't the first post.
					if ( $current_month && $current_year ) :
						echo '</ul>';
					endif;

					// Set the current year and month to this post's year and month.
					$current_year  = $year;
					$current_month = $month;
					$current_day   = '';

					echo '<h2 class="clean-my-archives__heading">' . date( 'F Y', $timestamp ) . '</h2>';

					// Open a new unordered list.
					echo '<ul>';
				endif;

				$day = '<span class="clean-my-archives__day">' . e( $daynum ) . ':</span>';

				// Check if there's a duplicate day so we can add a class.
				$duplicate_day = $current_day && $daynum === $current_day ? ' class="day-duplicate"' : '';
				$current_day   = $daynum;

				printf(
					'<li%s>%s <a href="%s" rel="bookmark">%s</a></li>',
					$duplicate_day,
					$day,
					e( $post->uri() ),
					e( $post->title() )
				);

			endforeach ?>

			</ul>
		</div>

		<?php endforeach ?>

	</main>
</section>

<?php \Benlumia007\Alembic\Engine::view( 'footer' )->display() ?>
