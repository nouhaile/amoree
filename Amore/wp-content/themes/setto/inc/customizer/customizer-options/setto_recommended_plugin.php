<?php
/* Notifications in customizer */
require SETTO_PARENT_INC_DIR . '/customizer/customizer-notify/setto-notify.php';
$setto_config_customizer = array(
	'recommended_plugins'       => array(
		'burger-companion' => array(
			'recommended' => true,
			'description' => sprintf(__('Install and activate <strong>Burger Companion</strong> plugin for taking full advantage of all the features this theme has to offer Setto.', 'setto')),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'setto' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'setto' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'setto' ),
	'activate_button_label'     => esc_html__( 'Activate', 'setto' ),
	'setto_deactivate_button_label'   => esc_html__( 'Deactivate', 'setto' ),
);
Setto_Customizer_Notify::init( apply_filters( 'setto_customizer_notify_array', $setto_config_customizer ) );
