<?php
// /**
//  * Demo Import.
//  *
//  * This is the template that assetss all the other files for core featured of Theme Palace
//  *
//  * @package Theme Palace
//  * @subpackage Girlish
//  * @since Girlish 1.0.0
//  */


function girlish_ctdi_plugin_page_setup( $default_settings ) {
    $default_settings['menu_title']  = esc_html__( 'Theme Palace Demo Import' , 'girlish' );

    return $default_settings;
}
add_filter( 'cp-ctdi/plugin_page_setup', 'girlish_ctdi_plugin_page_setup' );


function girlish_ctdi_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__( 'Dark', 'girlish' ),
            'categories'                   => array( ),
            'local_import_file'            => get_template_directory() . '/assets/demo/dark/content.xml',
            'local_import_widget_file'     => get_template_directory() . '/assets/demo/dark/widgets.wie',
            'local_import_customizer_file' => get_template_directory() . '/assets/demo/dark/customizer.dat',
            'import_preview_image_url'     => get_template_directory_uri() . '/assets/demo/dark/screenshot.jpg',
            'import_notice'                => esc_html__( 'Please wait for a few minutes, do not close the window or refresh the page until the data is imported.', 'girlish' ),
            'preview_url'                  => 'https://themepalacedemo.com/bloghill-dark',
        ),
        array(
            'import_file_name'             => esc_html__( 'Pro', 'girlish' ),
            'categories'                   => array( ),
            'local_import_file'            => get_template_directory() . '/assets/demo/pro/content.xml',
            'local_import_widget_file'     => get_template_directory() . '/assets/demo/pro/widgets.wie',
            'local_import_customizer_file' => get_template_directory() . '/assets/demo/pro/customizer.dat',
            'import_preview_image_url'     => get_template_directory_uri() . '/assets/demo/pro/screenshot.jpg',
            'import_notice'                => esc_html__( 'Please wait for a few minutes, do not close the window or refresh the page until the data is imported.', 'girlish' ),
            'preview_url'                  => 'https://themepalacedemo.com/girlish',
        ),
        array(
            'import_file_name'             => esc_html__( 'Business', 'girlish' ),
            'categories'                   => array( ),
            'local_import_file'            => get_template_directory() . '/assets/demo/business/content.xml',
            'local_import_widget_file'     => get_template_directory() . '/assets/demo/business/widgets.wie',
            'local_import_customizer_file' => get_template_directory() . '/assets/demo/business/customizer.dat',
            'import_preview_image_url'     => get_template_directory_uri() . '/assets/demo/business/screenshot.jpg',
            'import_notice'                => esc_html__( 'Please wait for a few minutes, do not close the window or refresh the page until the data is imported.', 'girlish' ),
            'preview_url'                  => 'https://themepalacedemo.com/bloghill-third-demo',
        ),
        array(
            'import_file_name'             => esc_html__( 'Music', 'girlish' ),
            'categories'                   => array( ),
            'local_import_file'            => get_template_directory() . '/assets/demo/music/content.xml',
            'local_import_widget_file'     => get_template_directory() . '/assets/demo/music/widgets.wie',
            'local_import_customizer_file' => get_template_directory() . '/assets/demo/music/customizer.dat',
            'import_preview_image_url'     => get_template_directory_uri() . '/assets/demo/music/screenshot.jpg',
            'import_notice'                => esc_html__( 'Please wait for a few minutes, do not close the window or refresh the page until the data is imported.', 'girlish' ),
            'preview_url'                  => 'https://themepalacedemo.com/bloghill-second-demo',
        ),
        array(
            'import_file_name'             => esc_html__( 'Shop', 'girlish' ),
            'categories'                   => array( ),
            'local_import_file'            => get_template_directory() . '/assets/demo/shop/content.xml',
            'local_import_widget_file'     => get_template_directory() . '/assets/demo/shop/widgets.wie',
            'local_import_customizer_file' => get_template_directory() . '/assets/demo/shop/customizer.dat',
            'import_preview_image_url'     => get_template_directory_uri() . '/assets/demo/shop/screenshot.jpg',
            'import_notice'                => esc_html__( 'Please wait for a few minutes, do not close the window or refresh the page until the data is imported.', 'girlish' ),
            'preview_url'                  => 'https://themepalacedemo.com/bloghill-shop',
        ),
       
    );
}
add_filter( 'cp-ctdi/import_files', 'girlish_ctdi_import_files' );



function girlish_ctdi_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
    $social = get_term_by('name', 'Social', 'nav_menu');

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
            'social' => $social->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'cp-ctdi/after_import', 'girlish_ctdi_after_import_setup' );
