<article class="post">

	<header class="entry-header">
		<h1 class="entry-title"><?= widow( e( $entry->title() ) ) ?></h1>
		<div class="entry-metadata">
			<?php if ( $entry->author() ) : ?>
				<span class="entry-author"><?php include( public_path( 'svg/user.svg.php' ) ); ?><a href="<?= e( uri() . '/about-me' ); ?>"><?= e( $entry->author()->title() ) ?></a></span>
			<?php endif ?>

			<?php if ( $entry->date() ) : ?>
				<span class="entry-date"><?php include( public_path( 'svg/calendar-alt.svg.php' ) ); ?><?= e( $entry->date() ) ?></span>
			<?php endif ?>
		</div>
	</header>

	<div class="entry-content">
		<?= $entry->content() ?>
	</div>

	<footer class="entry-taxonomies">
		<?php if ( $entry->terms( 'category' ) ) : ?>
			<?php foreach ( $entry->terms( 'category' ) as $term ) : ?>
				#<a href="<?= e( $term->uri() ) ?>"><?= e( $term->title() ) ?></a>
			<?php endforeach ?>
		<?php endif ?>
	</footer>

</article>
