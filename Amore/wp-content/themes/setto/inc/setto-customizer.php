<?php
/**
 * Setto Theme Customizer.
 *
 * @package Setto
 */

 if ( ! class_exists( 'Setto_Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 1.0.0
	 */
	class Setto_Customizer {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			/**
			 * Customizer
			 */
			add_action( 'customize_preview_init',                  array( $this, 'setto_customize_preview_js' ) );
			add_action( 'customize_register',                      array( $this, 'setto_customizer_register' ) );
			add_action( 'after_setup_theme',                       array( $this, 'setto_customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function setto_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';			
			
			
			/**
			 * Helper files
			 */
			require SETTO_PARENT_INC_DIR . '/customizer/sanitization.php';
		}
		
		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		function setto_customize_preview_js() {
			wp_enqueue_script( 'setto-customizer', SETTO_PARENT_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
		}

		// Include customizer customizer settings.
			
		function setto_customizer_settings() {			
			    require SETTO_PARENT_INC_DIR . '/customizer/customizer-options/setto-header.php';
			    require SETTO_PARENT_INC_DIR . '/customizer/customizer-options/setto-blog.php';
			    require SETTO_PARENT_INC_DIR . '/customizer/customizer-options/setto-footer.php';
			    require SETTO_PARENT_INC_DIR . '/customizer/customizer-options/setto-general.php';
				require SETTO_PARENT_INC_DIR . '/customizer/customizer-options/setto_recommended_plugin.php';
				require SETTO_PARENT_INC_DIR . '/customizer/customizer-options/setto_customizer_import_data.php';
				require SETTO_PARENT_INC_DIR . '/customizer/customizer-pro/class-customize.php';
		}

	}
}// End if().

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Setto_Customizer::get_instance();