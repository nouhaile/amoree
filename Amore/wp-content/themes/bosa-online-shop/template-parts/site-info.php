<?php
/**
 * Template part for displaying site info
 *
 * @package Bosa Online Shop 1.0.0
 */

?>

<div class="site-info">
	<?php echo wp_kses_post( html_entity_decode( esc_html__( 'Copyright &copy; ' , 'bosa-online-shop' ) ) );
		echo esc_html( date( 'Y' ) );
		printf( esc_html__( ' Bosa Online Shop. Powered by', 'bosa-online-shop' ) );
	?>
	<a href="<?php echo esc_url( __( '//bosathemes.com', 'bosa-online-shop' ) ); ?>" target="_blank">
		<?php
			printf( esc_html__( 'Bosa Themes', 'bosa-online-shop' ) );
		?>
	</a>
</div><!-- .site-info -->