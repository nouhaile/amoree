<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Setto
 */

get_header();
?>
<!-- Product Sidebar Section -->
<section id="product-section2" class="product-section2 section-ptb">
        <div class="container">
            <div class="row">
			<!--Product Detail-->
			<?php if ( ! is_active_sidebar( 'setto-woocommerce-sidebar' ) ) {	?>
				<div id="product-content" class="col-lg-12">
			<?php }else{ ?>
				<div id="product-content" class="col-lg-8">
			<?php } ?>	
				<?php woocommerce_content(); ?>
			</div>
			<!--/End of Blog Detail-->
			<?php get_sidebar('woocommerce'); ?>
		</div>	
	</div>
</section>
<!-- End of Blog & Sidebar Section -->
<?php get_footer(); ?>

