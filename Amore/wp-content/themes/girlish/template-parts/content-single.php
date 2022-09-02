<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */
$options = girlish_get_theme_options();
$class = has_post_thumbnail() ? '' : 'no-post-thumbnail';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear ' . $class ); ?>>

<?php if( $options['single_post_hide_image'] == false ):
if (has_post_thumbnail()): ?>
		<div class="featured-image">
		<a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url( 'large' ) ?>" alt="<?php the_title(); ?>"></a>
	</div>
	<?php endif;
	endif; ?>

	<?php if( $options['single_post_hide_description'] == false ): ?>
	<div class="entry-container">
		<div class="entry-content">
			<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'girlish' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'girlish' ),
				'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->
		</div><!-- .entry-container -->
	<?php endif; ?>

		<div class="entry-meta">
			<?php if ( ! $options['single_post_hide_author'] ) :
			echo girlish_author( get_the_author_meta( 'ID' ) );
			endif; 

			if ( ! $options['single_post_hide_date'] ) :
				girlish_posted_on(); 
			endif; ?>

			<?php  
			girlish_single_categories();
			girlish_entry_footer();
			?>

		</div><!-- .entry-meta -->

</article><!-- #post-## -->