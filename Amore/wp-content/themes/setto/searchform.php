<?php
/**
 * The template for displaying search form.
 *
 * @package     Setto
 * @since       1.0
 */
?>
<form class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" placeholder="<?php esc_attr_e( 'Search for:', 'setto' ); ?>" name="s" class="search-field">
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>