<article <?php hoot_attr( 'post' ); ?>>

	<?php if ( apply_filters( 'hoot_porto_display_404_title', true ) ) : ?>
		<header class="entry-header">
			<?php
			$loop_meta_displayed = hoot_data( 'loop_meta_displayed' );
			$containertag = ( $loop_meta_displayed ) ? 'h2' : 'h1';
			echo "<{$containertag} class='entry-title'>" . esc_html__( 'Nothing found', 'hoot-porto' ) . "</{$containertag}>";
			?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div <?php hoot_attr( 'entry-content', '', 'no-shadow' ); ?>>
		<div class="entry-the-content">
			<?php do_action( 'hoot_porto_404_content' ); ?>
		</div>
	</div><!-- .entry-content -->

</article><!-- .entry -->