<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Blossom_Magazine
 */
$error_image = get_theme_mod( 'error_show_image', get_template_directory_uri() . '/images/404-image.png' );

get_header(); ?>

    <div class="container">
        <section class="error-404 not-found">
            <div class="error-404-content-wrapper">
                <div class="error404-grid">
                    <?php if( $error_image ) { ?>
                        <figure class="error-img">
                            <img src="<?php echo esc_url( $error_image ); ?>">
                        </figure>
                    <?php } ?>
                    <div class="page-content">
                        <span class="error404-text"><?php esc_html_e( '404 Error', 'blossom-magazine' ); ?></span>
                        <h1 class="page-title"><?php esc_html_e( 'Page Not Found!', 'blossom-magazine' );?></h1>
                        <p><?php esc_html_e('The page you are looking for may have been moved, deleted, or possibly never existed.', 'blossom-magazine' ); ?></p>
                        <a class="wc-btn wc-btn-one"
                            href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'BRING ME TO HOMEPAGE', 'blossom-magazine' ); ?>
                        </a>
                        <div class="error-404-search">
                            <?php get_search_form(); ?>
                        </div>
                    </div><!-- .page-content -->
                </div>
            </div>
        </section><!-- .error-404 -->
    </div>
    <div class="container">
        <div class="page-grid">
            <div id="primary" class="content-area">
                <?php
                /**
                 * @see blossom_magazine_latest_posts
                */
                do_action( 'blossom_magazine_latest_posts' ); ?>
            </div><!-- #primary -->
        </div>
    </div>
<?php
get_footer();