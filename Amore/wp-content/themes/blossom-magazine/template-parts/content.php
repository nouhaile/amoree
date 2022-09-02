<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blossom_Magazine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); if( ! is_single() ) echo ' itemscope itemtype="https://schema.org/Blog"'; ?>>
	<?php 
        /** 
         * @hooked blossom_magazine_post_thumbnail - 20
        */
        do_action( 'blossom_magazine_before_post_entry_content' );
    
        /**
         * @hooked blossom_magazine_entry_header   - 10
         * @hooked blossom_magazine_entry_content - 15
         * @hooked blossom_magazine_entry_footer  - 20
        */
        do_action( 'blossom_magazine_post_entry_content' );
    ?>
</article><!-- #post-<?php the_ID(); ?> -->