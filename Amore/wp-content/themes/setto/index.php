<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
				<ul class="single-blog-area">
					<?php 
						$setto_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
						$args = array( 'post_type' => 'post','paged'=>$setto_paged );	
					?>
					<?php if( have_posts() ): ?>
						<?php while( have_posts() ) : the_post(); ?>
								<?php get_template_part('template-parts/content/content','page'); ?>
						<?php endwhile; ?>
					<?php else: ?>
						<?php get_template_part('template-parts/content/content','none'); ?>
					<?php endif; ?>
				</ul>
				<div class="paginatoin-area">
					<!--  Pagination Start  -->
						<?php								
						// Previous/next page navigation.
						the_posts_pagination( array(
						'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
						'next_text'          => '<i class="fa fa-angle-double-right"></i>',
						) ); ?>
					<!--  Pagination End  -->
				</div>
			</div>
			<?php  get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
