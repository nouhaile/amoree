<?php

        $options = girlish_get_theme_options();
        // Check if subscription is enabled on frontpage
        $subscribe_now_enable = apply_filters( 'girlish_section_status', true, 'subscribe_now_section_enable' );

        if ( true !== $subscribe_now_enable ) {
            return false;
        }

        if ( ! class_exists( 'Jetpack' ) ) {
            return;
        } elseif ( class_exists( 'Jetpack' ) ) {
            if ( ! Jetpack::is_module_active( 'subscriptions' ) )
                return;
        }

        $options = girlish_get_theme_options();
        $btn_label = ! empty( $options['subscribe_now_btn_text'] ) ? $options['subscribe_now_btn_text'] : esc_html__( 'Subscribe', 'girlish' );

        ?>
        <div id="girlish_subscribe_now_section" class="relative">
            <?php if ( is_customize_preview()):
                  girlish_section_tooltip( 'girlish_subscribe_now_section' );
                endif; ?>
            <div class="wrapper">
                <article style="background-image:url('<?php echo esc_url( $options['subscribe_now_bg_image'] ); ?>');">
                    <div class="entry-container">
                        <div class="section-header">
                            <?php if ( ! empty( $options['subscribe_now_title'] ) ) : ?>
                                <h2 class="section-title"><?php echo esc_html( $options['subscribe_now_title'] ); ?></h2>
                            <?php endif; ?>
                            <?php if ( ! empty( $options['subscribe_now_sub_title'] ) ) : ?>
                                <p><?php echo esc_html( $options['subscribe_now_sub_title'] ); ?></p>
                            <?php endif; ?>
                        </div><!-- .section-header -->

                        <div class="subscribe-form-wrapper">
                            <?php 
                            $subscribe_now_shortcode = '[jetpack_subscription_form title="" subscribe_text="" subscribe_button="' . esc_html( $btn_label ) . '" show_subscribers_total="0"]';
                            echo do_shortcode( wp_kses_post( $subscribe_now_shortcode ) ); 
                            ?>
                        </div><!-- .subscribe-form-wrapper -->
                    </div>
                </article>
            </div><!-- .wrapper -->
        </div><!-- #subscribe-now -->  