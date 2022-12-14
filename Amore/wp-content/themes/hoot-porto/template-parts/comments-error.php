<?php if ( pings_open() && !comments_open() ) : ?>

	<p class="comments-closed pings-open">
		<?php
			/* Translators: The two %s are placeholders for HTML. The order can't be changed. */
			printf( esc_html__( 'Comments are closed, but %1$strackbacks%2$s and pingbacks are open.', 'hoot-porto' ), '<a href="' . esc_url( get_trackback_url() ) . '">', '</a>' );
		?>
	</p><!-- .comments-closed .pings-open -->

<?php elseif ( !comments_open() ) : ?>

	<p class="comments-closed">
		<?php esc_html_e( 'Comments are closed.', 'hoot-porto' ); ?>
	</p><!-- .comments-closed -->

<?php endif; ?>