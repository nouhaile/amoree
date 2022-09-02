<?php
/**
 * Blossom Magazine Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package Blossom_Magazine
 */

function blossom_magazine_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'blossom-magazine' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'blossom-magazine' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'blossom-magazine' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'blossom-magazine' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'blossom-magazine' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'blossom-magazine' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'blossom-magazine' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'blossom-magazine' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'blossom-magazine' ),
            'id'          => 'footer-four', 
            'description' => __( 'Add footer four widgets here.', 'blossom-magazine' ),
        )
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }

}
add_action( 'widgets_init', 'blossom_magazine_widgets_init' );