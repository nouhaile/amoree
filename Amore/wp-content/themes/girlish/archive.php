<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */
$options = girlish_get_theme_options();
get_header(); 
?>

<div id="inner-content-wrapper" class="wrapper page-section">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="archive-blog-wrapper col-1 clear list-view">
				<?php
				if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
			</div>
					<?php  
					/**
					* Hook - girlish_action_pagination.
					*
					* @hooked girlish_pagination 
					*/
					do_action( 'girlish_action_pagination' ); 

					/**
					* Hook - girlish_infinite_loader_spinner_action.
					*
					* @hooked girlish_infinite_loader_spinner 
					*/
					do_action( 'girlish_infinite_loader_spinner_action' );
					?>
		</main>
	</div>

<?php  
if ( girlish_is_sidebar_enable() ) {
	get_sidebar();
}
?>
</div>

<?php
get_footer();