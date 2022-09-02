<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage Girlish
	 * @since Girlish 1.0.0
	 */

	/**
	 * girlish_doctype hook
	 *
	 * @hooked girlish_doctype -  10
	 *
	 */
	do_action( 'girlish_doctype' );

?>
<head>
<?php
	/**
	 * girlish_before_wp_head hook
	 *
	 * @hooked girlish_head -  10
	 *
	 */
	do_action( 'girlish_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<?php
	/**
	 * girlish_page_start_action hook
	 *
	 * @hooked girlish_page_start -  10
	 *
	 */
	do_action( 'girlish_page_start_action' ); 

	/**
	 * girlish_loader_action hook
	 *
	 * @hooked girlish_loader -  10
	 *
	 */
	do_action( 'girlish_before_header' );

	/**
	 * girlish_header_action hook
	 *
	 * @hooked girlish_header_start -  10
	 * @hooked girlish_site_branding -  20
	 * @hooked girlish_site_navigation -  30
	 * @hooked girlish_header_end -  50
	 *
	 */
	do_action( 'girlish_header_action' );

	/**
	 * girlish_content_start_action hook
	 *
	 * @hooked girlish_content_start -  10
	 *
	 */
	do_action( 'girlish_content_start_action' );

	/**
	 * girlish_header_image_action hook
	 *
	 * @hooked girlish_header_image -  10
	 *
	 */
	do_action( 'girlish_header_image_action' );

	if ( girlish_is_frontpage() ) {
    	$options = girlish_get_theme_options();
    	$sorted = array();
		if ( ! empty( $options['front_sortable'] ) ) {
			$sorted = explode( ',' , $options['front_sortable'] );
		}
		
		foreach ( $sorted as $section ) {
			add_action( 'girlish_primary_content', 'girlish_add_'. $section .'_section' );
		}

		do_action( 'girlish_primary_content' );
	}