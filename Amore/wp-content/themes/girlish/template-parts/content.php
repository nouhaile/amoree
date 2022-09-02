<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */
$class = has_post_thumbnail() ? 'has-post-thumbnail' : '';
$options = girlish_get_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>

    <?php if( $options['hide_image'] == false ):

        if( has_post_thumbnail() ){ ?>

            <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'large' ); ?>');">
                <a href="<?php the_permalink(); ?>" class="post-thumbnail-link"></a>
            </div><!-- .featured-image -->

        <?php } 

    endif; ?>

    <div class="entry-container">

        <?php if( $options['hide_title'] == false ): ?>

            <header class="entry-header">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>

        <?php endif; ?>

        <div class="entry-meta">
            <?php if ( $options['hide_category'] == false ): ?>

                <span class="cat-links">
                    <ul class="post-categories">
                        <li><?php the_category(); ?></li>
                    </ul><!-- .post-categories -->
                </span><!-- .cat-links -->

            <?php endif; ?>
            <?php
            if( !empty( $options['hide_date'] ) == false ):
                girlish_posted_on();
            endif;
            ?>
        </div>
        <?php
        if( !empty( $options['hide_description'] ) == false ): ?>
            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div><!-- .entry-content -->

        <?php endif; ?>

        <?php if ( !empty( $options['read_more_text'] ) ): ?>
            <div class="read-more">
                <a href="<?php the_permalink(); ?>" class="btn"><?php echo esc_html( $options['read_more_text'] ); ?></a>
            </div><!-- .read-more -->
        <?php endif ?>


    </div><!-- .entry-container -->
</article>