<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
			<?php 
				if ( class_exists( 'woocommerce' ) ) 
					{
						
						if( is_account_page() || is_cart() || is_checkout() ) {
								echo '<div class="blog-grid-wrap col-lg-'.( !is_active_sidebar( "setto-woocommerce-sidebar" ) ?"12" :"8" ).'">'; 
						}
						else{ 
					
						echo '<div class="blog-grid-wrap col-lg-'.( !is_active_sidebar( "setto-sidebar-primary" ) ?"12" :"8" ).'">'; 
						
						}
						
					}
					else
					{ 
					
						echo '<div class="blog-grid-wrap col-lg-'.( !is_active_sidebar( "setto-sidebar-primary" ) ?"12" :"8" ).'">';
						
						
					} 
				?>
				<?php if( have_posts()) : the_post(); ?>
						<?php the_content(); ?>
				<?php
					endif;
					
					if( $post->comment_status == 'open' ) { 
						 comments_template( '', true ); // show comments 
					}
				?>
			</div>
			<?php  
				if ( class_exists( 'WooCommerce' ) ) 
					if( is_account_page() || is_cart() || is_checkout() ) {
						get_sidebar('woocommerce');
					}else{
				
				get_sidebar(); 
				} 
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>