<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Setto
 */

get_header();
?>
<div class="page-not-found section-ptb">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="search-error-wrapper">
					<div class="img-text">
						<img src="<?php echo esc_url(get_template_directory_uri() .'/assets/images/404.png'); ?>" />
					</div>
					<a class="btn btn-style3" href="<?php echo esc_url( home_url( '/' ) ); ?>" data-text="<?php echo esc_attr_e('Back to homepage','setto'); ?>">
						<span><?php echo esc_html_e('Back to homepage','setto'); ?></span>
						<i class="fa fa-home"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
