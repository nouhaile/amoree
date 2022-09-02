<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Setto
 */

get_header();
?>
<div class="blog-content-wrap section-ptb">
	<div class="container">
		<div class="row right-wrap">
			<div class="<?php esc_attr(setto_post_layout()); ?> blog-grid-wrap">
				<?php if( have_posts() ): ?>
			
					<?php while( have_posts() ) : the_post(); ?>
				
						<?php get_template_part('template-parts/content/content','page'); ?>
					
					<?php endwhile; ?>
					
				<?php else: ?>
				
					<?php get_template_part('template-parts/content/content','none'); ?>
					
				<?php endif; ?>
			</div>
			<?php  get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
