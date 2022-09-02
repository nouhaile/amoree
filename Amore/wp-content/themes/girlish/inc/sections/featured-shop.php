<?php
/**
 * featured_shop section
 *
 * This is the template for the content of featured_shop section
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */
if ( ! function_exists( 'girlish_add_featured_shop_section' ) ) :
    /**
    * Add featured_shop section
    *
    *@since Girlish 1.0.0
    */
    function girlish_add_featured_shop_section() {
        $options = girlish_get_theme_options();
        // Check if featured_shop is enabled on frontpage
        $featured_shop_enable = apply_filters( 'girlish_section_status', true, 'featured_shop_section_enable' );

        if ( ( true !== $featured_shop_enable ) || ! class_exists( 'WooCommerce' ) ) {
            return false;
        }

        // Get featured_shop section details
        $section_details = array();
        $section_details = apply_filters( 'girlish_filter_featured_shop_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render featured_shop section now.
        girlish_render_featured_shop_section( $section_details );
    }
endif;

if ( ! function_exists( 'girlish_get_featured_shop_section_details' ) ) :
    /**
    * featured_shop section details.
    *
    * @since Girlish 1.0.0
    * @param array $input featured_shop section details.
    */
    function girlish_get_featured_shop_section_details( $input ) {
        $options = girlish_get_theme_options();   
        $featured_shop_count = 3;
        
        $content = array();

        $page_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['featured_shop_content_product_' . $i] ) )
                $page_ids[] = $options['featured_shop_content_product_' . $i];
        }

        $args = array(
            'post_type'         => 'product',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => absint( $featured_shop_count ),
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
        return $input;
    }
endif;
// featured_shop section content details.
add_filter( 'girlish_filter_featured_shop_section_details', 'girlish_get_featured_shop_section_details' );


if ( ! function_exists( 'girlish_render_featured_shop_section' ) ) :
  /**
   * Start featured_shop section
   *
   * @return string featured_shop content
   * @since Girlish 1.0.0
   *
   */
   function girlish_render_featured_shop_section( $content_details = array() ) {
        $options = girlish_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="girlish_featured_shop_section" class="relative">
            <?php if ( is_customize_preview()):
                girlish_section_tooltip( 'girlish_featured_shop_section' );
            endif; ?>
            <div class="wrapper">
                <?php if ( !empty( $options['featured_shop_title'] ) ) : ?>
                    <div class="section-header-wrapper">
                        <div class="section-header">
                            <h2 class="section-title"><?php echo esc_html( $options['featured_shop_title'] ); ?></h2>
                        </div><!-- .section-header -->
                    </div><!-- .section-header-wrapper -->
                <?php endif; ?>

                <div class="section-content">
                    <div class="col-3">
                    <?php foreach ( $content_details as $content ): $product = new WC_Product( $content['id'] ); ?> 
                        <article>
                            <div class="featured-image" style="background-image:url('<?php echo esc_url( $content['image'] ); ?>');">
                                <div class="featured-overlay">
                                    <div class="bg-color"></div>
                                </div>
                                <div class="entry-container">
                                    <header class="entry-header">
                                        <h2 class="woocommerce-loop-product__title"><a href="#"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                        <div class="product_meta"><a href="#" class="woocommerce-LoopProduct-link woocommerce-loop-product__link" tabindex="0">
                                            <?php 
                                            $terms = get_the_terms ( $content['id'], 'product_cat' );
                                            foreach ( $terms as $term ) { ?>
                                                <span class="posted_in">
                                                    <a href="<?php echo esc_url( get_term_link( $term->term_id, 'product_cat' ) ) ?>"><?php echo esc_html( $term->name) ; ?></a>
                                                </span><!-- .posted_in -->
                                            <?php } ?>
                                            <!-- .posted_in -->
                                        </div>
                                    </header>

                                    <div class="icon-container">
                                        <span class="price">
                                            <?php echo $product->get_price_html(); ?>
                                        </span>
                                        <?php if(class_exists('YITH_WCWL')) echo do_shortcode( '[yith_wcwl_add_to_wishlist product_id='.$content['id'].']' ); ?>
                                        <a href="<?php echo do_shortcode( '[add_to_cart_url id="' .absint( $product->get_id() ). '"]' ); ?>" class="product_type_simple add_to_cart_button ajax_add_to_cart">
                                            <?php echo girlish_get_svg( array( 'icon' => 'cart' ) ); ?>
                                        </a>
                                    </div><!-- .icon-container -->
                                </div><!-- .entry-container -->
                            </div><!-- .featured-image -->
                        </article>
                    <?php endforeach; ?>
                    </div><!-- .col-3 --> 
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #garlish_pro_featured_shop -->

    <?php }
endif;