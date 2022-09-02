<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'girlish_reset_section', array(
	'title'             => esc_html__('Reset all settings','girlish'),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'girlish' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'girlish_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'girlish_sanitize_checkbox',
	'transport'			  => 'postMessage',
) );

$wp_customize->add_control( 'girlish_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'girlish' ),
	'section'           => 'girlish_reset_section',
	'type'              => 'checkbox',
) );
