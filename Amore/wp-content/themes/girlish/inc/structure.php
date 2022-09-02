<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Girlish
 * @since Girlish 1.0.0
 */

$options = girlish_get_theme_options();


if ( ! function_exists( 'girlish_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Girlish 1.0.0
	 */
	function girlish_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'girlish_doctype', 'girlish_doctype', 10 );


if ( ! function_exists( 'girlish_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
		<?php endif;
	}
endif;
add_action( 'girlish_before_wp_head', 'girlish_head', 10 );

if ( ! function_exists( 'girlish_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'girlish' ); ?></a>

		<?php
	}
endif;
add_action( 'girlish_page_start_action', 'girlish_page_start', 10 );

if ( ! function_exists( 'girlish_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'girlish_page_end_action', 'girlish_page_end', 10 );



if ( ! function_exists( 'girlish_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_site_branding() {
		$options  = girlish_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];	 ?>
		<div class="menu-overlay"></div>
		<header id="masthead" class="site-header center-aligned" role="banner">
			<div class="wrapper">
				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" title="Primary Menu">
						<?php
						echo girlish_get_svg( array( 'icon' => 'menu', 'class' => 'icon-menu' ) );
						echo girlish_get_svg( array( 'icon' => 'close', 'class' => 'icon-menu' ) );
						?>	
						<span class="menu-label"><?php esc_html_e('Menu', 'girlish')?></span>		
					</button>
					<?php  
					$social_menu= null;
					if($options['social_menu'] && has_nav_menu( 'social' )):
						
						$social_menu = sprintf('<li class="social-menu">%1$s</li>',
							wp_nav_menu(  array(
								'theme_location' => 'social',
								'container' => 'div',
								'container_class' => 'social-icons',
								'echo' => false,
								'depth' => 1,
								'link_before' => '<span class="screen-reader-text">',
								'link_after' => '</span>',
								'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'fallback_cb' => false,
							) )
						);

					endif;

					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => 'div',
						'menu_class' => 'menu nav-menu',
						'menu_id' => 'primary-menu',
						'echo' => true,
						'fallback_cb' => 'girlish_menu_fallback_cb',
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s'.$social_menu.'</ul>',
					) );


					?>
				</nav><!-- #site-navigation -->
				<div class="site-branding">
					<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) ) && has_custom_logo()  ) : ?>
					<div class="site-logo">
						<?php the_custom_logo(); ?>
					</div>
				<?php endif; 

				if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
					<div id="site-identity">
						<?php
						if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) { 
							if ( girlish_is_latest_posts() || girlish_is_frontpage() ) : ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	                            <?php else : ?>
	                                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
	                            <?php
                            endif;
						} 
						if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
								<?php
							endif; 
						}?>
					</div>
				<?php endif; ?>
				</div>
				<div class="icon-wrapper">
					<?php if($options['social_menu'] && has_nav_menu( 'social' )):
						$button = '';
						if ( !empty( $options['menu_btn_label'] ) && !empty( $options['menu_btn_url'] ) ) {
							$button = '<li class="custom-button"><a href="'. esc_url( $options['menu_btn_url'] ) .'">' . esc_html( $options['menu_btn_label'] ) . '</a></li>';
						}

						wp_nav_menu(  array(
							'theme_location' => 'social',
							'container' => 'div',
							'container_class' => 'social-icons',
							'depth' => 1,
							'link_before' => '<span class="screen-reader-text">',
							'link_after' => '</span>',
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' .$button. '</ul>',
							'fallback_cb' => false,
						) );
					

					endif; ?>
				</div>
			</div><!-- .site-branding-container-->
		</header>
		<?php
	}
endif;
add_action( 'girlish_header_action', 'girlish_site_branding', 20 );


if ( ! function_exists( 'girlish_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'girlish_content_start_action', 'girlish_content_start', 10 );

if ( ! function_exists( 'girlish_header_image' ) ) :
	/**
	 * Header Image codes
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_header_image() {
		if ( girlish_is_frontpage() )
			return;
		$header_image = get_header_image();
		?>

		<div id="page-site-header" class="relative" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
                <header class="page-header">
                    <?php girlish_custom_header_banner_title(); ?>
                </header>

                <?php girlish_add_breadcrumb(); ?>
            </div><!-- .wrapper -->
        </div><!-- #page-site-header -->
		<?php
	}
endif;
add_action( 'girlish_header_image_action', 'girlish_header_image', 10 );

if ( ! function_exists( 'girlish_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since Girlish 1.0.0
	 */
	function girlish_add_breadcrumb() {
		$options = girlish_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		
		// Bail if Home Page.
		if ( girlish_is_frontpage() ) {
			return;
		}

		echo '<div id="breadcrumb-list">';
				/**
				 * girlish_simple_breadcrumb hook
				 *
				 * @hooked girlish_simple_breadcrumb -  10
				 *
				 */
				do_action( 'girlish_simple_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
		return;
	}
endif;

if ( ! function_exists( 'girlish_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_content_end() {
		?>
			
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'girlish_content_end_action', 'girlish_content_end', 10 );

if ( ! function_exists( 'girlish_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_footer_start() {

		$options = girlish_get_theme_options();
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">

		<?php
	}
endif;
add_action( 'girlish_footer', 'girlish_footer_start', 10 );

if ( ! function_exists( 'girlish_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_footer_site_info() {
		$options = girlish_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );
        $theme_data = wp_get_theme();
		$copyright_text = $options['copyright_text'];

		$footer_logo = !empty( $options['footer_logo'] ) ? $options['footer_logo'] : '';
		?>

		<?php if ($options['footer_enable'] == true ): ?>

			<div class="site-info col-2">
                <div class="wrapper">
                <?php if ( !empty( $footer_logo ) ) : ?>
                	<a href="<?php esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $footer_logo ); ?>" alt="footer-logo"></a>
                <?php endif; ?>
                <span class="copyright">
                	<?php 
                	echo girlish_santize_allow_tag( $copyright_text ); 
                	?>

                	<?php echo esc_html__( ' | All Rights Reserved | ', 'girlish' ) . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'girlish' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( ucwords( $theme_data->get( 'Author' ) ) ) .'</a>' ?>
                </span>
                
                </div><!-- .wrapper -->    
            </div><!-- .site-info -->
			
		<?php endif; ?>

		<?php
	}
endif;
add_action( 'girlish_footer', 'girlish_footer_site_info', 40 );

if ( ! function_exists( 'girlish_footer_scroll_to_top' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_footer_scroll_to_top() {
		$options  = girlish_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop"><?php echo girlish_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php endif;
	}
endif;
add_action( 'girlish_footer', 'girlish_footer_scroll_to_top', 40 );

if ( ! function_exists( 'girlish_footer_end' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_footer_end() {
		?>
		</footer>
		<div class="popup-overlay"></div>
		<?php
	}
endif;
add_action( 'girlish_footer', 'girlish_footer_end', 100 );

if ( ! function_exists( 'girlish_loader' ) ) :
	/**
	 * Start div id #loader
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_loader() {
		$options = girlish_get_theme_options();
		if ( $options['loader_enable'] ) { ?>

			<div id="loader">
            <div class="loader-container">
            	<?php if ( 'default' == $options['loader_icon'] ) : ?>
	                <div id="preloader">
	                    <span></span>
	                    <span></span>
	                    <span></span>
	                    <span></span>
	                    <span></span>
	                </div>
	            <?php else :
	            	echo girlish_get_svg( array( 'icon' => esc_attr( $options['loader_icon'] ) ) );
	            endif; ?>
            </div>
        </div><!-- #loader -->
        <div class="menu-overlay"></div>
		<?php }
	}
endif;
add_action( 'girlish_before_header', 'girlish_loader', 10 );

if ( ! function_exists( 'girlish_infinite_loader_spinner' ) ) :
	/**
	 *
	 * @since Girlish 1.0.0
	 *
	 */
	function girlish_infinite_loader_spinner() { 
		$id = get_the_ID();
		$options = girlish_get_theme_options();
		if ( $options['pagination_type'] == 'infinite' ) :
			if ( ! empty( $id ) ) {
				echo '<div class="blog-loader">' . girlish_get_svg( array( 'icon' => 'spinner-umbrella' ) ) . '</div>';
			}
		endif;
	}
endif;
add_action( 'girlish_infinite_loader_spinner_action', 'girlish_infinite_loader_spinner', 10 );
