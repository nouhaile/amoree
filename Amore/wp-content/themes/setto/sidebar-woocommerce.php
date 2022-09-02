<?php
/**
 * side bar template
 */
?>
<?php if ( ! is_active_sidebar( 'setto-woocommerce-sidebar' ) ) {	return; } ?>
<div class="col-xl-3 col-lg-4 col-md-5 col-12 blog-grid-wrap">
	<div class="blog-sidebar-wrap">
		<?php dynamic_sidebar('setto-woocommerce-sidebar'); ?>
	</div>
</div>