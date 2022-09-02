<?php
class setto_import_dummy_data {

	private static $instance;

	public static function init( ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof setto_import_dummy_data ) ) {
			self::$instance = new setto_import_dummy_data;
			self::$instance->setto_setup_actions();
		}

	}

	/**
	 * Setup the class props based on the config array.
	 */
	

	/**
	 * Setup the actions used for this class.
	 */
	public function setto_setup_actions() {

		// Enqueue scripts
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'setto_import_customize_scripts' ), 0 );

	}
	
	

	public function setto_import_customize_scripts() {

	wp_enqueue_script( 'setto-import-customizer-js', SETTO_PARENT_INC_URI . '/customizer/customizer-notify/js/setto-import-customizer-options.js', array( 'customize-controls' ) );
	}
}

$setto_import_customizers = array(

		'import_data' => array(
			'recommended' => true,
			
		),
);
setto_import_dummy_data::init( apply_filters( 'setto_import_customizer', $setto_import_customizers ) );