<?php
$options = girlish_get_theme_options();
        // Check if about is enabled on frontpage
$testimonial_enable = apply_filters( 'girlish_section_status', true, 'testimonial_section_enable' );

if ( true !== $testimonial_enable ) {
    return false;
}
$content = array();

$page_id = ! empty( $options['testimonial_content_page'] ) ? $options['testimonial_content_page'] : '';
$args = array(
    'post_type'         => 'page',
    'page_id'           => $page_id,
    'posts_per_page'    => 1,
);                    


$query = new WP_Query( $args );
if ( $query->have_posts() ) : 
    while ( $query->have_posts() ) : $query->the_post();
        $page_post['title']     = get_the_title();
        $page_post['id']        = get_the_id();
        $page_post['url']       = get_the_permalink();
        $page_post['excerpt']   = girlish_trim_content( $options['testimonial_excerpt_length'] );
        $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-590x650.jpg';

                // Push to the main array.
        array_push( $content, $page_post );
    endwhile;
endif;
wp_reset_postdata();

if ( ! empty( $content ) ) {
    $input = $content;
}
?>

<?php foreach ( $input as $content ) { ?>
    <div id="girlish_testimonial_section" class="relative">
        <?php if ( is_customize_preview()):
            girlish_section_tooltip( 'girlish_testimonial_section' );
        endif; ?>
        <div class="wrapper">
            <article style="background-image:url('<?php echo esc_url( $content['image'] ); ?>');">
                <div class="entry-container">
                    <?php if ( !empty ( $options['testimonial_title'] ) ) : ?>
                        <div class="section-header">
                            <h2 class="section-title"><?php echo esc_html(  $options['testimonial_title'] ); ?></h2>
                        </div>
                    <?php endif; ?>

                    <div class="section-content">
                        <div class="entry-content">
                            <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                        </div><!-- .entry-content -->

                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                            <?php if(!empty($options['testimonial_position'])):?>
                                <span><?php echo esc_html($options['testimonial_position']); ?></span>
                            <?php endif; ?>
                        </header>
                    </div><!-- .section-contain -->
                </div><!-- .entry-container -->
            </article>
        </div><!-- .wrapper -->
    </div><!-- .garlish_pro_testimonial_section -->
<?php }