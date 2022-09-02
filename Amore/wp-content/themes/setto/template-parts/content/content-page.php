<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Setto
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-post mb-4'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php echo esc_url(the_permalink()); ?>" class="blog-img banner-hover">
			<?php the_post_thumbnail(); ?>
			<span class="blog-icon"><i class="fa fa-link"></i></span>
			<span class="date-time">
				<span class="date"><?php echo esc_html(get_the_date('j')); ?></span>,
				<span class="time"><?php echo esc_html(get_the_date('M')); ?></span>,
				<span class="year"><?php echo esc_html(get_the_date(' Y')); ?></span>
			</span>
		</a>
	<?php endif; ?>		
	<div class="blog-post-content">
		<?php
			if ( is_single() ) :

				the_title('<h5 class="post-title">', '</h5>' );
				
			else:
				
				the_title( sprintf( '<h5 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
				
			endif; 
			
			the_content( 
					sprintf( 
						__( 'Read More', 'setto' ), 
						'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
					) 
				);
		?>
	</div>
</div>