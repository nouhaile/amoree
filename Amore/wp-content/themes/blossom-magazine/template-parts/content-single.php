<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blossom_Magazine
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 
        
        echo '<div class="content-wrap">';

        /**
         * @hooked blossom_magazine_entry_header  - 10
         * @hooked blossom_magazine_entry_content - 15
         * @hooked blossom_magazine_entry_footer  - 20
        */
        do_action( 'blossom_magazine_post_entry_content' );
        
        echo '</div>';
    ?>
</article><!-- #post-<?php the_ID(); ?> -->