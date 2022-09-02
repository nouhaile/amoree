<?php
/**
 * Popular Category Section
 */

$ed_pop_cat    = get_theme_mod( 'ed_category_section', false );
$cat1          = get_theme_mod( 'pop_cat_one' ); 
$cat2          = get_theme_mod( 'popular_cat_section_select_two' ); 
$cat3          = get_theme_mod( 'pop_cat_three' );
$show_author   = get_theme_mod( 'ed_show_author_popular_cat_section', true );
$show_date     = get_theme_mod( 'ed_show_date_popular_cat_section', true );
$image_crop    = get_theme_mod( 'ed_image_crop_popular_cat_section', true );
$btn_lbl       = get_theme_mod( 'popular_cat_section_viewall_lbl', __( 'View All', 'blossom-magazine' ) ); 
$posts_no      = get_theme_mod( 'pop_cat_posts_no_l4', 4 );


if( $ed_pop_cat && ( $cat1 || $cat2 || $cat3 ) ){
    echo '<div id="popular_cat_section" class="category-section">';

    blossom_magazine_get_categories_section( $cat1, $cat2, $cat3, $posts_no, $show_author, $show_date, $image_crop, $btn_lbl );

    echo '</div>';
}