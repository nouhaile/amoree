<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	<div class="product">
		<div class="product-single">
			<div class="single-product-wrap">
			 <div class="product-image">
				<a class="pro-img" href="<?php echo esc_url(the_permalink()); ?>">
					<img class="img-fluid img1" src="<?php echo esc_url(the_post_thumbnail_url()); ?>" alt="<?php the_title(); ?>">
					<?php
						$attachment_ids = $product->get_gallery_image_ids();
						if(!empty($attachment_ids)):
							foreach( $attachment_ids as $i=> $attachment_id ) {
							$image_url2 = wp_get_attachment_url( $attachment_id );
							if($i==1):
					?>
					<img class="img-fluid img2" src="<?php  echo esc_url($image_url2); ?>" alt="<?php the_title(); ?>" />
					<?php endif; } else: ?>
						<img class="img-fluid img2" src="<?php echo esc_url(the_post_thumbnail_url()); ?>" alt="<?php the_title(); ?>">
					<?php endif; ?>
				</a>
				<?php if ( $product->is_on_sale() ) : ?>
					<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="product-label"><span class="percent-count">' . esc_html__( 'Sale', 'setto' ) . '</span></div>', $post, $product ); ?>
				<?php endif; ?>
				<div class="wishlist-desktop">
				   <?php 
					if(class_exists( 'YITH_WCWL' )) { echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); }
					?>
				</div>
				<div class="product-action">
				   <?php  do_action( 'woocommerce_after_shop_loop_item' ); ?>
				</div>
			 </div>
			 <div class="product-content">
				<div class="product-title">
				   <a href="<?php echo esc_url(the_permalink()); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</div>
				<div class="price-box">
				   <?php  echo $product->get_price_html(); ?>
				</div>
			 </div>
		  </div>
		</div>	
	</div>
</li>
