<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Setto
 */

get_header();
?>
<div class="blog-content-wrap section-ptb">
	<div class="container">
		<div class="row right-wrap">
			<div class="<?php esc_attr(setto_post_layout()); ?> blog-grid-wrap">
				<div class="single-blog-area">
					<?php if( have_posts() ): ?>
						<?php while( have_posts() ): the_post(); ?>
							<div class="blog-post-single">
								<div class="blog-image">
									<?php the_post_thumbnail(); ?>
								</div>
								<div class="blog-revert">
									<?php
										if ( is_single() ) :

											the_title('<h5 class="post-title">', '</h5>' );
											
										else:
											
											the_title( sprintf( '<h5 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
											
										endif; 
									?>
								</div>
								<div class="blog-content">
									<div class="blog-wrap-desc">
										<?php
											the_content( 
													sprintf( 
														__( 'Read More', 'setto' ), 
														'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
													) 
												);
										?>
									</div>
								</div>
								<div class="post-info">
									<blockquote>
										<i class="fa fa-quote-left"></i>
										<h5 class="post-title">
											<span><?php echo esc_html_e('By','setto'); ?> <?php esc_html(the_author()); ?></span>
										</h5>
										<ul>
											<li class="date-time">
												<i class="fa fa-calendar"></i>
												<span><?php echo esc_html(get_the_date('j')); ?>,
													<?php echo esc_html(get_the_date('M')); ?>,
													<?php echo esc_html(get_the_date('Y')); ?>													
												</span>
											</li>
											<li class="blog-comment">
												<i class="fa fa-comment"></i>
												<span class="comment-count"><?php echo esc_html(get_comments_number($post->ID)); ?></span>
												<span><?php echo esc_html_e('Comments','setto'); ?></span>
											</li>
										</ul>
									</blockquote>
								</div>
								<div class="post-info-tag">
									<ul class="post-tag">
										<li><a href="<?php esc_url(the_permalink()); ?>"><?php the_tags('', ', ', ''); ?></a></li>
									</ul>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
					<?php comments_template( '', true ); // show comments  ?>
				</div>
			</div>
			<?php  get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
