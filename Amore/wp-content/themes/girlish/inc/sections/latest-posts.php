<?php 

$options = girlish_get_theme_options();
// Check if primary posts is enabled on frontpage
$latest_posts_enable = apply_filters( 'girlish_section_status', true, 'latest_posts_section_enable' );

if ( true !== $latest_posts_enable ) {
     return false;
}

$latest_posts_count = 3;

$content = array();

$post_ids = array();

for ( $i = 1; $i <= $latest_posts_count; $i++ ) {
    if ( ! empty( $options['latest_posts_content_post_' . $i] ) )
        $post_ids[] = $options['latest_posts_content_post_' . $i];
}

$args = array(
    'post_type'         => 'post',
    'post__in'          => ( array ) $post_ids,
    'posts_per_page'    => absint( $latest_posts_count ),
    'orderby'           => 'post__in',
    'ignore_sticky_posts'   => true,
);                    


// Run The Loop.
$query = new WP_Query( $args );
if ( $query->have_posts() ) : 
    while ( $query->have_posts() ) : $query->the_post();
$page_post['id']        = get_the_id();
$page_post['auth_id']   = get_the_author_meta('ID');
$page_post['title']     = get_the_title();
$page_post['url']       = get_the_permalink();
$page_post['excerpt']   = girlish_trim_content( $options['latest_posts_excerpt_length'] );
$page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'large' ) : get_template_directory_uri(). '/assets/uploads/no-featured-image-600x450.jpg';

// Push to the main array.
array_push( $content, $page_post );
endwhile;
endif;
wp_reset_postdata();

if ( ! empty( $content ) ) {
    $input = $content;
}

?>
<?php
$latest_posts_btn_url = !empty( $options['latest_posts_btn_url'] ) ? $options['latest_posts_btn_url'] : '';
?>

    <div id="girlish_latest_posts_section" class="relative page-section">
        <?php if ( is_customize_preview()):
            girlish_section_tooltip( 'girlish_latest_posts_section' );
        endif; ?>
        <div class="wrapper">
            <div class="section-header-wrapper clear">
                <?php if ( !empty ( $options['latest_posts_title'] ) ) : ?>
                    <div class="section-header">
                        <h2 class="section-title"><?php echo esc_html( $options['latest_posts_title'] ); ?></h2>
                    </div>
                <?php endif; ?>

                <?php if ( !empty( $latest_posts_btn_url ) ) : ?>
                    <div class="read-more">
                        <a href="<?php echo esc_url( $latest_posts_btn_url ); ?>" class="btn"><?php echo esc_html( $options['latest_posts_btn_text']); ?></a>
                    </div>
                <?php endif; ?>
                
            </div>

            <div class="section-cntent col-3">
                <?php foreach( $input as $content ) : ?>
                    <article>
                        <div class="post-wrapper">
                            <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a>
                            </div>

                            <div class="entry-container">
                                <div class="entry-meta">
                                    <span class="cat-links">
                                        <?php the_category( '', '', $content['id'] ) ?>
                                    </span><!-- .cat-links -->

                                    <?php girlish_posted_on($content['id']); ?>
                                </div><!-- .entry-meta -->

                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                </header>
                            </div><!-- .entry-container -->
                        </div><!-- .post-wrapper -->
                    </article>
                <?php endforeach; ?>

            </div><!-- .col-3 -->

            <?php if ( !empty( $latest_posts_btn_url ) ) : ?>
                <div class="read-more">
                    <a href="<?php echo esc_url( $latest_posts_btn_url ); ?>" class="btn"><?php echo esc_html( $options['latest_posts_btn_text']); ?></a>
                </div>
            <?php endif; ?>
        </div><!-- .wrapper -->
    </div><!-- #garlish_pro_latest_posts -->


