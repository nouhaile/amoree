<?php

$options = girlish_get_theme_options();
        // Check if collection is enabled on frontpage
$collection_enable = apply_filters( 'girlish_section_status', true, 'collection_section_enable' );

if ( ( true !== $collection_enable ) || ! class_exists( 'WooCommerce' ) ) {
    return false;
}
    
$collection_count = 5;
$content = array();

$page_ids = array();

for ( $i = 1; $i <= $collection_count; $i++ ) {
    if ( ! empty( $options['collection_content_product_' . $i] ) )
        $page_ids[] = $options['collection_content_product_' . $i];
}

$args = array(
    'post_type'         => 'product',
    'post__in'          => ( array ) $page_ids,
    'posts_per_page'    => absint( $collection_count ),
    'orderby'           => 'post__in',
);


// Run The Loop.
$query = new WP_Query( $args );
if ( $query->have_posts() ) : 
    while ( $query->have_posts() ) : $query->the_post();
        $page_post['id']        = get_the_id();
        $page_post['title']     = get_the_title();
        $page_post['url']       = get_the_permalink();
        $page_post['excerpt']   = girlish_trim_content( 10 );
        $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'medium_large' ) : get_template_directory_uri().'/assets/uploads/no-featured-image-600x450.jpg';

                // Push to the main array.
        array_push( $content, $page_post );
    endwhile;
endif;
wp_reset_postdata();

if ( ! empty( $content ) ) {
    $input = $content;
}

?>
    <div id="girlish_collection_section" class="page-section">
        <?php if ( is_customize_preview()):
            girlish_section_tooltip( 'girlish_collection_section' );
        endif; ?>
        <div class="section-header-wrapper clear">
            <div class="wrapper">
                 <?php if ( !empty( $options['collection_title'] ) ) : ?>
                     <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html( $options['collection_title'] ); ?></h2>
                        <div class="entry-header-image">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/uploads/01.png' ); ?>">
                        </div>
                    </div><!-- .section-header -->
                <?php endif; ?>

                <?php if ( !empty( $options['collection_description'] ) ) : ?>
                    <div class="header-content">
                        <p><?php echo esc_html( $options['collection_description'] ); ?></p>
                    </div><!-- .header-content -->
                <?php endif; ?>
            </div>
        </div><!-- .section-header-wrapper --> 

        <div class="section-content col-5">
            <div class="wrapper">
                <?php foreach ( $input as $content ): $product = new WC_Product( $content['id'] ); ?> 
                    <article>
                        <div class="entry-container">
                            <span class="price">
                                <?php echo $product->get_price_html(); ?>
                            </span>
                            <div class="seperator"></div>
                            <header class="entry-header">
                               <div class="product_meta"><a href="#" class="woocommerce-LoopProduct-link woocommerce-loop-product__link" tabindex="0">
                                <span class="posted_in"></span></a><?php 
                                $terms = get_the_terms ( $content['id'], 'product_cat' );
                                foreach ( $terms as $term ) { ?>
                                    <a href="<?php echo esc_url( get_term_link( $term->term_id, 'product_cat' ) ) ?>"><?php echo esc_html( $term->name) ; ?></a>
                                <?php } ?>

                                <!-- .posted_in -->
                            </div>
                            <h2 class="woocommerce-loop-product__title"><a href="<?php echo esc_url( $content['url']); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                        </header>
                    </div><!-- .entry-container -->

                    <div class="featured-image" style="background-image:url('<?php echo esc_url( $content['image']); ?>');"></div><!-- .featured-image -->
                    </article>
                <?php endforeach; ?>
            </div><!-- .wrapper -->
        </div><!-- .section-content -->
    </div><!-- .garlish_pro_cta_section -->