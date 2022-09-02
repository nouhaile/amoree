<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Setto
 */

get_header();
?>
<div class="blog-content-wrap section-ptb">
	<div class="container">
		<div class="row right-wrap">
			<div class="<?php esc_attr(setto_post_layout()); ?> blog-grid-wrap">
				<ul class="single-blog-area">
					<?php if( have_posts() ): ?>
				
						<?php while( have_posts() ) : the_post(); ?>
								<?php get_template_part('template-parts/content/content','search'); ?>
						<?php		
							endwhile; 
							the_posts_navigation();
						?>
					<?php else: ?>
					
						<?php get_template_part('template-parts/content/content','none'); ?>
						
					<?php endif; ?>
				</ul>
			</div>
			<?php  get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
