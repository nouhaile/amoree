<?php
/**
 * Frontpage CTA section
 */
$ed_cta      = get_theme_mod( 'ed_cta_section', false );
$sec_title   = get_theme_mod( 'cta_section_title' );
$cta_button  = get_theme_mod( 'cta_btn_lbl',__( 'Subscribe Now', 'blossom-magazine' ) );
$button_link = get_theme_mod( 'cta_btn_link' );
$target      = get_theme_mod( 'cta_link_new_tab', false ) ? ' target=_blank' : '';
$icon_type   = get_theme_mod( 'icon_type', 'icon' );
$cta_image   = get_theme_mod( 'cta_image', '' );
$cta_icon    = get_theme_mod( 'cta_icon', 'fas fa-location-arrow' );
$image_id    = attachment_url_to_postid( $cta_image );

if( $ed_cta ){ ?>
    <div id="cta_section" class="cta-section section">
        <div class="container">
            <div class="cta-section-wrapper">
                <div class="grid">
                    <?php if( $sec_title || ( $icon_type == 'image' && $cta_image ) || ( $icon_type == 'icon' && $cta_icon) ) { ?>
                        <div class="grid-item">
                            <h2 class="section-titl">
                                <?php if( $icon_type == 'image' && $cta_image ){ ?>
                                    <div class="cta-image">
                                        <?php echo wp_get_attachment_image( $image_id, 'thumbnail', true ); ?>
                                    </div>
                                <?php } elseif( $icon_type == 'icon' && $cta_icon){ ?>
                                    <div class="cta-image">
                                        <i class="<?php echo esc_attr( $cta_icon ); ?>"></i>
                                    </div>
                                <?php } 
                                if ( $sec_title ) echo '<span>' . esc_html( $sec_title ) . '</span>'; ?>
                            </h2>
                        </div>
                    <?php } if( $cta_button && $button_link ) { ?>
                        <div class="grid-item">
                        <a class="btn-cta btn-1" href="<?php echo esc_url( $button_link ); ?>"<?php echo esc_attr( $target ); ?>> 
                                <?php echo esc_html( $cta_button ); ?> 
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>