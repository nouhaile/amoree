<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage Girlish
* @since Girlish 1.0.0
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'girlish_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'girlish_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content'],
) );

$wp_customize->add_control( 'girlish_theme_options[enable_frontpage_content]', array(
	'label'       	=> esc_html__( 'Enable Content', 'girlish' ),
	'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'girlish' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
	'active_callback' => 'girlish_is_static_homepage_enable',
) );