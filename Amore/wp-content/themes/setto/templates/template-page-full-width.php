<?php 
/**
Template Name:Page Full Width
*/

get_header();
?>
<div class="blog-content-wrap section-ptb">
	<div class="container">
		<div class="row left-wrap">
			<div class="col-xl-12 col-lg-12 col-md-12 blog-grid-wrap">
				 <?php 		
						the_post(); the_content(); 
						
						if( $post->comment_status == 'open' ) { 
							 comments_template( '', true ); // show comments 
						}
					?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>