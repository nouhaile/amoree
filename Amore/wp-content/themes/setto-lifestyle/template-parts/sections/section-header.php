<?php do_action('setto_header_image'); ?>
<?php do_action('setto_above_header'); ?>
<!--===// Start: Main Header
=================================-->
<div id="setto-header" class="setto-header">
	<!-- header-area start -->
	<div class="header header-five">
		<div class="<?php echo esc_attr(setto_sticky_menu()); ?>">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<div class="header-area">
							<div class="header-main">
								<div class="header-element megamenu-content">
									<div class="mainwrap">
										 <?php do_action('setto_primary_navigation'); ?>
									</div>
								</div>
								<div class="header-element logo">
									<?php do_action('setto_header_logo'); ?>
								</div>                                    
								<div class="header-element right-block-box">
									<ul class="shop-element">
										<li class="side-wrap toggler-wrap">
											<button class="navbar-toggler" type="button">
												<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
													<line x1="3" y1="12" x2="21" y2="12"></line>
													<line x1="3" y1="6" x2="21" y2="6"></line>
													<line x1="3" y1="18" x2="21" y2="18"></line>
												</svg>
											</button>
										</li>
										<?php 
										 do_action('setto_header_desktop_search');
										if ( class_exists( 'woocommerce' ) ) {
											do_action('setto_header_my_account');
											do_action('setto_header_cart');
										}?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php do_action('setto_header_search_popup'); ?>
		<div class="header-bottom-area">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="main-menu-area">
							<nav class="main-navigation navbar-expand-xl">
								<div class="box-header">
									<button class="close-box" type="button"><i class="fa fa-close"></i></button>
								</div>
								<div class="navbar-collapse" id="navbarContent">
									<div class="megamenu-content">
										<a href="javascript:void(0)" class="browse-cat" data-bs-toggle="collapse" aria-expanded="false">
											<i class="fa fa-bars"></i>
											<span><?php echo esc_html_e('Menu','setto-lifestyle'); ?></span>
										</a>
										<div class="mainwrap">
											<?php do_action('setto_primary_navigation'); ?>
										</div>
									</div>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- header-area end -->
</div>