<?php  
	$setto_blog_hs 			= get_theme_mod('blog_hs','1');
	$setto_blog_title 		= get_theme_mod('blog_title');
	$setto_blog_display_num = get_theme_mod('blog_display_num','3');
	if($setto_blog_hs=='1'):
?>		
<div id="blog-section" class="blog-section home1">
	<div class="blog-wrap">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-12">
					<?php if(!empty($setto_blog_title)): ?>
						<div class="section-capture">
							<div class="section-title">
								<h2><?php echo wp_kses_post($setto_blog_title); ?></h2>
							</div>
						</div>
					<?php endif; ?>
					<div class="blog-slider owl-carousel owl-theme" id="blog-slider">
						<?php 	
							$setto_blogs_args = array( 'post_type' => 'post', 'posts_per_page' => $setto_blog_display_num,'post__not_in'=>get_option("sticky_posts")) ; 	
						$setto_blog_wp_query = new WP_Query($setto_blogs_args);
						if($setto_blog_wp_query)
						{	
						while($setto_blog_wp_query->have_posts()):$setto_blog_wp_query->the_post(); 
						?>
						<div class="item">
							<?php get_template_part('template-parts/content/content','page'); ?>
						</div>
						<?php	endwhile; }	wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>