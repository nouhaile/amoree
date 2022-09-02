<?php
/**
 * Right Buttons Panel.
 *
 * @package Blossom_Magazine
 */
?>
<div class="panel-right">
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Upgrade To Pro', 'blossom-magazine' ); ?></h4>
		<p><?php esc_html_e( 'With the Pro version, you can change the look and feel of your website in seconds. In just a few clicks, you can change the color and typography of your website. The premium version lets you have better control over the theme as it comes with more customization options. Not just that, the theme also has more sections and layout options as compared to the free version. The Pro version is multi-language compatible as well.', 'blossom-magazine' ); ?></p>
		<p><?php esc_html_e( 'You will also get more frequent updates and quicker support with the Pro version.', 'blossom-magazine' ); ?></p>
		<a class="button button-primary" href="<?php echo esc_url( 'https://blossomthemes.com/wordpress-themes/blossom-magazine-pro/' ); ?>" title="<?php esc_attr_e( 'View Premium Version', 'blossom-magazine' ); ?>" target="_blank">
            <?php esc_html_e( 'Read More About the Pro Theme', 'blossom-magazine' ); ?>
        </a>
	</div><!-- .panel-aside Theme Support -->
	<!-- Knowledge base -->
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Visit the Knowledge Base', 'blossom-magazine' ); ?></h4>
		<p><?php esc_html_e( 'Need help with using the WordPress as quickly as possible? Visit our well-organized Knowledge Base!', 'blossom-magazine' ); ?></p>
		<p><?php esc_html_e( 'Our Knowledge Base has step-by-step video and text tutorials, from installing the WordPress to working with themes and more.', 'blossom-magazine' ); ?></p>

		<a class="button button-primary" href="<?php echo esc_url( 'https://docs.blossomthemes.com/' . BLOSSOM_MAGAZINE_THEME_TEXTDOMAIN . '/' ); ?>" title="<?php esc_attr_e( 'Visit the knowledge base', 'blossom-magazine' ); ?>" target="_blank"><?php esc_html_e( 'Visit the Knowledge Base', 'blossom-magazine' ); ?></a>
	</div><!-- .panel-aside knowledge base -->
</div><!-- .panel-right -->