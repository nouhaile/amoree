<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blossom_Magazine
 */
    
    /**
     * After Content
     * 
     * @hooked blossom_magazine_content_end         - 20
     * @hooked blossom_magazine_newsletter          - 30
     * @hooked blossom_magazine_instagram_section   - 40
    */
    do_action( 'blossom_magazine_before_footer' );
    
    /**
     * Footer
     * 
     * @hooked blossom_magazine_footer_start        - 20
     * @hooked blossom_magazine_footer_top          - 30
     * @hooked blossom_magazine_footer_bottom       - 40
     * @hooked blossom_magazine_footer_end          - 50
    */
    do_action( 'blossom_magazine_footer' );
    
    /**
     * After Footer
     * 
     * @hooked blossom_magazine_back_to_top         - 15
     * @hooked blossom_magazine_page_end            - 20
    */
    do_action( 'blossom_magazine_after_footer' );

    wp_footer(); ?>

</body>
</html>