<?php 

/**
* Main posts wrapper section
*
* This is the template for the content of about section
*
* @package Theme Palace
* @subpackage Girlish
* @since Girlish 1.0.0
*/

if ( ! function_exists( 'girlish_add_home_inner_content_wrapper_section' ) ) :
/**
* Add recent section
*
*@since Girlish 1.0.0
*/
function girlish_add_home_inner_content_wrapper_section() {
    $options = girlish_get_theme_options();
?>
    <div id="home-inner-content-wrapper">
        <?php

            // collection section
            require get_template_directory() . '/inc/sections/collection.php'; 

            // testimonial section
            require get_template_directory() . '/inc/sections/testimonial.php';

            // latest posts section
            require get_template_directory() . '/inc/sections/latest-posts.php';

            // subscribe now section
            require get_template_directory() . '/inc/sections/subscribe-now.php';
        ?>
    </div>

<?php }
endif;