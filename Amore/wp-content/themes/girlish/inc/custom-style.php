<?php


function girlish_style( $args = array() ) {
		$options = girlish_get_theme_options();
	?>

		<style type="text/css">

		<?php if ( is_customize_preview() ): ?>
			.page-section:hover{
				border: 3px solid;
			}
		<?php endif ?>

		</style>
		
<?php }

add_action( 'wp_head', 'girlish_style' );