</div>
<div class="mm-fullscreen-bg"></div>

    <!--===// Start: Footer
    =================================-->
	<div id="footer-section" class="footer-section footer1">
		<div class="footer-top-area">
			<div class="container">
				<?php  if ( is_active_sidebar( 'setto-footer-widget-area' ) ) { ?>
					<div class="row">
						<?php  dynamic_sidebar( 'setto-footer-widget-area' ); ?>
					</div>
				<?php }
				do_action('setto_below_footers'); ?>
			</div>
		</div>
	</div>
	
	<?php  
		$hs_footer_btm_logo = get_theme_mod('hs_footer_btm_logo','1');
		$footer_copyright 	= get_theme_mod('footer_copyright','Copyright &copy; [current_year] [site_title] | Powered by [theme_author]');
		$hs_footer_social 	= get_theme_mod('hs_footer_social','1');
		if ( function_exists( 'burger_companion_activate' ) ) : 
			$footer_social_icons = get_theme_mod('footer_social_icons',setto_get_social_icon_default());
		else: 
			$footer_social_icons = get_theme_mod('footer_social_icons');
		endif;
		if($hs_footer_btm_logo=='1' || $hs_footer_social=='1'  || !empty($footer_copyright)):
	?>
		<div id="copy-right-section" class="copy-right-section copy-right1">
			<div class="footer-bottom-area">
				<div class="container">
					<div class="row">
						<div class="col">
							<ul class="ft-bottom">
								<?php if ( ! empty( $footer_copyright ) ){ 				
									$setto_copyright_allowed_tags = array(
										'[current_year]' => date_i18n('Y'),
										'[site_title]'   => get_bloginfo('name'),
										'[theme_author]' => sprintf(__('<a href="https://burgerthemes.com/setto-free/" target="_blank">Setto</a>', 'setto')),
									);
								?>                          
									<li class="copy-right text-lg-start text-center">
										<p>
											<?php
												echo apply_filters('setto_footer_copyright', wp_kses_post(setto_str_replace_assoc($setto_copyright_allowed_tags, $footer_copyright)));
											?>
										</p>
									</li>
								<?php } ?>
								
								 <?php if($hs_footer_social=='1'){ ?>
									<li class="social-medea text-lg-end text-center">
										<ul class="social-icon">
											<?php
												$footer_social_icons = json_decode($footer_social_icons);
												if( $footer_social_icons!='' )
												{
												foreach($footer_social_icons as $payment_item){	
												$social_icon = ! empty( $payment_item->icon_value ) ? apply_filters( 'setto_translate_single_string', $payment_item->icon_value, 'Footer section' ) : '';	
												$social_link = ! empty( $payment_item->link ) ? apply_filters( 'setto_translate_single_string', $payment_item->link, 'Footer section' ) : '';
											?>
												<li><a href="<?php echo esc_url( $social_link ); ?>"><i class="fa <?php echo esc_attr( $social_icon ); ?>"></i></a></li>
											<?php }} ?>
										</ul>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
    <!-- End: Footer
    =================================-->

    <!--===// Start: Scroll to top
    =================================-->
		 <a href="javascript:void(0)" id="top" class="scroll"><i class="fa fa-arrow-up"></i></a>
    <!-- End: Scroll to top
    =================================-->	

</div>		
<?php wp_footer(); ?>
</body>
</html>
