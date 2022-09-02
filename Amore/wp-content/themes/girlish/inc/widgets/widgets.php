<?php
/**
 * Theme Palace widgets inclusion
 *
 * This is the template that includes all custom widgets of Girlish
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

/*
 * Add Popular Posts widget
 */
require get_template_directory() . '/inc/widgets/most-read-post-widget.php';

/*
 * Add Editor Choice widget
 */
require get_template_directory() . '/inc/widgets/editor-choice-widget.php';

/*
 * Add Editor Choice widget
 */
require get_template_directory() . '/inc/widgets/trending-posts-widget.php';


/*
 * Add social link widget
 */
require get_template_directory() . '/inc/widgets/social-link-widget.php';


/**
 * Register widgets
 */
function girlish_register_widgets() {

	register_widget( 'Bloghill_editor_choice' );

	register_widget( 'Bloghill_Trending_Posts' );
	
	register_widget( 'girlish_Most_Read_Post' );

	register_widget( 'girlish_Social_Link' );

}
add_action( 'widgets_init', 'girlish_register_widgets' );