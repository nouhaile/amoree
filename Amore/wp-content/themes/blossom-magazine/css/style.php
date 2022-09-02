<?php
/**
 * Blossom Magazine Dynamic Styles
 * 
 * @package Blossom_Magazine
*/
if( ! function_exists( 'blossom_magazine_dynamic_css' ) ) :

function blossom_magazine_dynamic_css(){
    
    $primary_font    = get_theme_mod( 'primary_font', 'Questrial' );
    $primary_fonts   = blossom_magazine_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Source Serif Pro' );
    $secondary_fonts = blossom_magazine_get_fonts( $secondary_font, 'regular' );
    $font_size       = get_theme_mod( 'font_size', 18 );
    
    $site_title_font      = get_theme_mod( 'site_title_font', array( 'font-family'=>'Source Serif Pro', 'variant'=>'regular' ) );
    $site_title_fonts     = blossom_magazine_get_fonts( $site_title_font['font-family'], $site_title_font['variant'] );
    $site_title_font_size = get_theme_mod( 'site_title_font_size', 30 );
     
    $primary_color    = get_theme_mod( 'primary_color', '#A60505' );
	$secondary_color  = get_theme_mod( 'secondary_color', '#1A0101' );
    $site_title_color = get_theme_mod( 'site_title_color', '#111111' );
	$logo_width       = get_theme_mod( 'logo_width', 150 );
    
    $rgb = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $primary_color ) );
    $rgb2 = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $secondary_color ) );

    $cta_bg_color      = get_theme_mod( 'cta_bg_color', '#fff9f9' );
    $cta_font_color    = get_theme_mod( 'cta_font_color', '#1A0101' );
    
    $foot_bg_color   = get_theme_mod( 'footer_bg_color', '#483434' );
    $foot_font_color = get_theme_mod( 'footer_font_color', '#ffffff' );
    $rgb3            = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $foot_font_color ) );

    echo "<style type='text/css' media='all'>"; ?>
     
	:root {
		--primary-color: <?php echo blossom_magazine_sanitize_hex_color( $primary_color ); ?>;
		--primary-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2] ); ?>;
		--secondary-color: <?php echo blossom_magazine_sanitize_hex_color( $secondary_color ); ?>;
		--secondary-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb2[0], $rgb2[1], $rgb2[2] ); ?>;
        --primary-font: <?php echo esc_html( $primary_fonts['font'] ); ?>;
        --secondary-font: <?php echo esc_html( $secondary_fonts['font'] ); ?>;
		--footer-text-color: <?php echo blossom_magazine_sanitize_hex_color( $foot_font_color ); ?>;
        --footer-text-color-rgb: <?php printf('%1$s, %2$s, %3$s', $rgb3[0], $rgb3[1], $rgb3[2] ); ?>;

	}
    
    .site-title{
        font-size   : <?php echo absint( $site_title_font_size ); ?>px;
        font-family : <?php echo esc_html( $site_title_fonts['font'] ); ?>;
        font-weight : <?php echo esc_html( $site_title_fonts['weight'] ); ?>;
        font-style  : <?php echo esc_html( $site_title_fonts['style'] ); ?>;
    }
    
    .site-title a{
		color: <?php echo blossom_magazine_sanitize_hex_color( $site_title_color ); ?>;
	}

	.custom-logo-link img{
        width    : <?php echo absint( $logo_width ); ?>px;
        max-width: 100%;
    }

    .cta-section .cta-section-wrapper {
        background: <?php echo blossom_magazine_sanitize_hex_color( $cta_bg_color ); ?>;
        color: <?php echo blossom_magazine_sanitize_hex_color( $cta_font_color ); ?>;
	}
    
    /*Typography*/
	
	body {
        font-family : <?php echo esc_html( $primary_fonts['font'] ); ?>;
        font-size   : <?php echo absint( $font_size ); ?>px;        
    }
    
    .btn-readmore::before, 
    .btn-link::before{
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='6.106' height='9.573' viewBox='0 0 6.106 9.573'%3E%3Cpath id='Path_29322' data-name='Path 29322' d='M0,0,4.9,4.083,0,8.165' transform='translate(0.704 0.704)' fill='none' stroke='<?php echo blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ); ?>' stroke-linecap='round' stroke-linejoin='round' stroke-width='1'/%3E%3C/svg%3E%0A");
    }

    .comments-area .comment-list .comment .comment-body .reply .comment-reply-link::before, 
    .comments-area ol .comment .comment-body .reply .comment-reply-link::before {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='6.106' height='9.573' viewBox='0 0 6.106 9.573'%3E%3Cpath id='Path_29322' data-name='Path 29322' d='M4.9,0,0,4.083,4.9,8.165' transform='translate(0.5 0.704)' fill='none' stroke='<?php echo blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ); ?>' stroke-linecap='round' stroke-linejoin='round' stroke-width='1'/%3E%3C/svg%3E%0A");
    }

    .footer-t .widget_bttk_image_text_widget .bttk-itw-holder li .btn-readmore ,
    .footer-t .widget_bttk_popular_post .style-three li .entry-header, 
    .footer-t .widget_bttk_pro_recent_post .style-three li .entry-header,
    .site-footer {
        background-color: <?php echo blossom_magazine_sanitize_hex_color( $foot_bg_color ); ?>;
    }

    <?php echo "</style>";
}
endif;
add_action( 'wp_head', 'blossom_magazine_dynamic_css', 99 );

/**
 * Function for sanitizing Hex color 
 */
function blossom_magazine_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}
/**
 * Convert '#' to '%23'
*/
function blossom_magazine_hash_to_percent23( $color_code ){
    $color_code = str_replace( "#", "%23", $color_code );
    return $color_code;
}

/**
 * convert hex to rgb
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/
function blossom_magazine_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

if ( ! function_exists( 'blossom_magazine_gutenberg_inline_style' ) ) : 
/**
 * Gutenberg Dynamic Style
 */
function blossom_magazine_gutenberg_inline_style(){

    $primary_font    = get_theme_mod( 'primary_font', 'Questrial' );
    $primary_fonts   = blossom_magazine_get_fonts( $primary_font, 'regular' );
    $secondary_font  = get_theme_mod( 'secondary_font', 'Source Serif Pro' );
    $secondary_fonts = blossom_magazine_get_fonts( $secondary_font, 'regular' );
    $primary_color    = get_theme_mod( 'primary_color', '#A60505' );
    $secondary_color  = get_theme_mod( 'secondary_color', '#1A0101' );

    $rgb  = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $primary_color ) );
    $rgb2 = blossom_magazine_hex2rgb( blossom_magazine_sanitize_hex_color( $secondary_color ) );
        
    $custom_css = ':root .block-editor-page {
        --primary-font: ' . esc_html($primary_fonts['font']) . ';
        --secondary-font: ' . esc_html($secondary_fonts['font']) . ';
        --primary-color: ' . blossom_magazine_sanitize_hex_color($primary_color) . ';
        --primary-color-rgb: ' . sprintf('%1$s, %2$s, %3$s', $rgb[0], $rgb[1], $rgb[2]) . ';
        --secondary-color: ' . blossom_magazine_sanitize_hex_color($secondary_color) . ';
        --secondary-color-rgb: ' . sprintf('%1$s, %2$s, %3$s', $rgb2[0], $rgb2[1], $rgb2[2]) . ';
    }

    blockquote.wp-block-quote::before {
        background-image: url(\'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="127.432" height="110.665" viewBox="0 0 127.432 110.665"%3E%3Cg id="Group_1443" data-name="Group 1443" transform="translate(0 0)" opacity="0.3"%3E%3Cpath id="Path_5841" data-name="Path 5841" d="M194.147,345.773c-3.28,2.743-6.38,5.4-9.538,7.955-2.133,1.724-4.343,3.3-6.522,4.934-6.576,4.932-13.3,5.586-20.243,1.173-2.939-1.868-4.314-5.268-5.477-8.714a68.381,68.381,0,0,1-2.375-9.783c-.994-5.555-2.209-11.138-1.557-16.906.577-5.112,1.16-10.251,2.163-15.248a23.117,23.117,0,0,1,3.01-7.026c2.8-4.7,5.735-9.276,8.779-13.732a23.928,23.928,0,0,1,4.793-5.371c2.207-1.72,3.608-4.17,5.148-6.6,3.216-5.068,6.556-10.013,9.8-15.052a28.681,28.681,0,0,0,1.475-3.084c.163-.338.31-.795.563-.943,2.775-1.632,5.518-3.377,8.376-4.752,2.016-.97,3.528,1.238,5.25,2.057a3.4,3.4,0,0,1-.148,1.769c-1.535,3.621-3.138,7.2-4.71,10.8-3.534,8.085-7.357,16-10.514,24.308-3.248,8.542-6.275,17.324-6.5,27.026-.065,2.869.266,5.75.374,8.627.065,1.753,1.017,1.914,2.044,1.753a11.21,11.21,0,0,0,7.146-4.324c1.41-1.752,2.246-1.821,3.817-.239,2.013,2.029,3.923,4.218,5.856,6.367a1.677,1.677,0,0,1,.429,1.023c-.151,3.187-.352,6.379-2.323,8.826C191.077,343.331,191.107,343.7,194.147,345.773Z" transform="translate(-70.424 -252.194)" fill="' . blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ) . '"/%3E%3Cpath id="Path_5842" data-name="Path 5842" d="M259.193,344.341c-4.6,5.231-8.984,10.521-15.185,12.561a11.207,11.207,0,0,0-3.233,2.286c-5.3,4.46-11.216,4.268-17.085,2.977-4.218-.928-6.7-5.277-7.252-10.588-.948-9.07.893-17.566,3.187-26,.1-.381.287-.73.373-1.114,1.88-8.435,5.937-15.587,9.2-23.164,2.257-5.249,5.674-9.732,8.694-14.758.6,1.231.936,2.1,1.4,2.854.947,1.552,2.144,1.065,2.942-.529a12.559,12.559,0,0,0,.69-2.028c.39-1.313,1.017-1.885,2.24-.981-.207-2.706-.034-5.343,2.121-6.4.81-.4,2.093.691,3.288,1.15.659-1.414,1.61-3.271,2.38-5.236a4.422,4.422,0,0,0-.234-2.1c-.3-1.353-.733-2.666-.974-4.032a11.511,11.511,0,0,1,1.917-8.21c1.1-1.825,2.033-3.8,3.059-5.687,2.014-3.709,4.517-4.035,7.155-.948a17.668,17.668,0,0,0,2.386,2.7,5.03,5.03,0,0,0,2.526.767,7.3,7.3,0,0,0,2.09-.458c-.477,1.277-.81,2.261-1.2,3.2-4.945,11.79-10.1,23.454-14.784,35.4-3.468,8.844-6.331,18.054-9.458,27.1a6.573,6.573,0,0,0-.226.964c-.649,3.651.393,4.769,3.4,4.056,2.592-.618,4.313-3.327,6.743-4.071a16.177,16.177,0,0,1,5.847-.563c1.236.087,2.6,3.97,2.248,6.047-.7,4.12-1.9,8.009-4.311,11.09C258.068,341.977,257.566,343.062,259.193,344.341Z" transform="translate(-216.183 -252.301)" fill="' . blossom_magazine_hash_to_percent23( blossom_magazine_sanitize_hex_color( $primary_color ) ) . '"/%3E%3C/g%3E%3C/svg%3E%0A\');
    }';

    return $custom_css;
}
endif;