<?php

/**
 * Dynamic Style
 */
add_filter( 'sparklestore-style-dynamic-css', 'sparkle_mart_dymanic_styles', 100 );
function sparkle_mart_dymanic_styles($dynamic_css) {
    
    $primary_color = get_theme_mod('sparklestore_primary_theme_color_options');
        
    $rgba = sparklestore_hex2rgba($primary_color, 0.8);
	if($primary_color){
		
		$dynamic_css .= "
		.woocommerce ul.products li.product .price del, .store_products_item_details .price del, .woocommerce div.product p.price del, .woocommerce div.product span.price del{
			color: {$primary_color};
		}
		";


        $dynamic_css .="
            .single-product div.product .entry-summary .flash .store_sale_label,
            .store_products_item .flash > .store_sale_label{
                background-color: {$primary_color};
            }
            .single-product div.product .entry-summary .flash .on_sale,
            .woocommerce ul.products li.product .on_sale, .store_products_item_body .flash .on_sale{
                background-color: {$rgba};
            }
        ";
	}
	
	wp_add_inline_style( 'sparkle-mart-style', $dynamic_css );
}