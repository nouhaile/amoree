<?php
/**
* Customizer default options
*
* @package Theme Palace
* @subpackage Girlish
* @since Girlish 1.0.0
* @return array An array of default values
*/

function girlish_get_default_theme_options() {
	$theme_data = wp_get_theme();
	$girlish_default_options = array(
		// Color Options
		'header_title_color'			=> '#2c2d39',
		'header_tagline_color'			=> '#990f12',
		'header_txt_logo_extra'			=> 'show-all',
		'colorscheme_hue'				=> '#990f12',
		'colorscheme'					=> 'default',
		'theme_version'					=> 'lite-version',
		'home_layout'					=> 'default-design',

		// loader
		'loader_enable'         		=> (bool) false,
		'loader_icon'         			=> 'default',

		// breadcrumb
		'breadcrumb_enable'				=> (bool) true,
		'breadcrumb_separator'			=> '/',

		// layout 
		'site_layout'         			=> 'wide-layout',
		'sidebar_position'         		=> 'right-sidebar',
		'post_sidebar_position' 		=> 'right-sidebar',
		'page_sidebar_position' 		=> 'right-sidebar',
		'menu_sticky'					=> (bool) true,
		'menu_search'					=> (bool) true,
		'social_menu'					=> (bool) true,
		'menu_btn_label'				=> esc_html__( 'SHOP', 'girlish' ),

		// pagination options
		'pagination_enable'         	=> (bool) true,
		'pagination_type'         		=> 'default',

		// footer options
		'copyright_text'           		=> sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s', '1: Year, 2: Site Title with home URL', 'girlish' ), '[the-year]', '[site-link]' ),
		'scroll_top_visible'        	=> (bool) true,
		'footer_menu'        			=> (bool) true,
		'footer_enable'        			=> (bool) true,

		// reset options
		'reset_options'      			=> (bool) false,

		// homepage options
		'enable_frontpage_content' 		=> (bool) false,

		// homepage sections sortable
		'sortable'	        => 'hero_banner,featured_shop,collection,testimonial,latest_posts,subscribe_now',

		'front_sortable'	=> 'hero_banner,featured_shop,home_inner_content_wrapper',
		
		// blog/archive options
		'your_latest_posts_title' 		=> esc_html__( 'Blogs', 'girlish' ),
		'read_more_text' 		        => esc_html__( 'Read More', 'girlish' ),
		'hide_image'					=> (bool) false,
		'hide_category'					=> (bool) false,
		'hide_author'					=> (bool) false,
		'hide_title'					=> (bool) false,
		'hide_description'				=> (bool) false,
		'hide_date'				        => (bool) false,

		// single post theme options
		'single_post_hide_date' 		=> (bool) false,
		'single_post_hide_author'		=> (bool) false,
		'single_post_hide_category'		=> (bool) false,
		'single_post_hide_tags'			=> (bool) false,
		'single_post_hide_image'		=> (bool) false,
		'single_post_hide_description'	=> (bool) false,

		/* Front Page */

		//hero_banner 
		'hero_banner_section_enable'	=> (bool) false,
		'hero_banner_excerpt_length'	=> 30,
		'hero_banner_content_type'		=> 'post',
		'hero_banner_btn_text'			=> esc_html__( 'Read More', 'girlish' ),
		'hero_banner_alt_btn_text'		=> esc_html__( 'Read More', 'girlish' ),

		// featured shop
		'featured_shop_section_enable'	=> (bool) false,
		'featured_shop_title'		    => esc_html__('Shop quality products from creators and brands, gets the best discount.','girlish'),


		//collection
		'collection_section_enable'	=> (bool) false,
		'collection_title'		    => esc_html__('COLLECTION, STYLE FOR ALL.','girlish'),
		'collection_description'		    => esc_html__('Although fashion and technology are often perceived as entirely distinct fields, the two have always intersected — generally to the betterment of both industries.','girlish'),

		//testimonial 
		'testimonial_section_enable'	=> (bool) false,
		'testimonial_excerpt_length'	=> 30,
		'testimonial_title'			=> esc_html__( 'LOVE CLIENT', 'girlish' ),

		// latest_posts
		'latest_posts_section_enable'		=> false,
		'latest_posts_title'			=> esc_html__( 'FROM BLOG', 'girlish' ),
		'latest_posts_btn_text'			=> esc_html__( 'READ ALL BLOGS', 'girlish' ),
		'latest_posts_excerpt_length'		=> 20,

		// subscribe_now
		'subscribe_now_section_enable'	=> false,
		'subscribe_now_sub_title'		=> esc_html__( 'Everyone wants the outcome, but in order to be motivated to work towards it, day in and day out, you have to learn to get some rest.', 'girlish' ),
		'subscribe_now_title'			=> esc_html__( 'Subscribe Newsletter', 'girlish' ),
		'subscribe_now_btn_text'			=> esc_html__( 'Subscribe', 'girlish' ),

		
		);

$output = apply_filters( 'girlish_default_theme_options', $girlish_default_options );

// Sort array in ascending order, according to the key:
if ( ! empty( $output ) ) {
	ksort( $output );
}

return $output;
}