<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

/**
 * girlish_footer_primary_content hook
 *
 * @hooked girlish_add_contact_section -  10
 *
 */
do_action( 'girlish_footer_primary_content' );

/**
 * girlish_content_end_action hook
 *
 * @hooked girlish_content_end -  10
 *
 */
do_action( 'girlish_content_end_action' );

/**
 * girlish_content_end_action hook
 *
 * @hooked girlish_footer_start -  10
 * @hooked girlish_Footer_Widgets->add_footer_widgets -  20
 * @hooked girlish_footer_site_info -  40
 * @hooked girlish_footer_end -  100
 *
 */
do_action( 'girlish_footer' );

/**
 * girlish_page_end_action hook
 *
 * @hooked girlish_page_end -  10
 *
 */
do_action( 'girlish_page_end_action' ); 

?>

<?php wp_footer(); ?>

</body>
</html>
