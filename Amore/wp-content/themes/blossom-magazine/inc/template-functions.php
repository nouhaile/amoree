<?php
/**
 * Blossom Magazine Template Functions which enhance the theme by hooking into WordPress
 *
 * @package Blossom_Magazine
 */

if( ! function_exists( 'blossom_magazine_doctype' ) ) :
/**
 * Doctype Declaration
*/
function blossom_magazine_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'blossom_magazine_doctype', 'blossom_magazine_doctype' );

if( ! function_exists( 'blossom_magazine_head' ) ) :
/**
 * Before wp_head 
*/
function blossom_magazine_head(){ ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'blossom_magazine_before_wp_head', 'blossom_magazine_head' );

if( ! function_exists( 'blossom_magazine_page_start' ) ) :
/**
 * Page Start
*/
function blossom_magazine_page_start(){ ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content (Press Enter)', 'blossom-magazine' ); ?></a>
    <?php
}
endif;
add_action( 'blossom_magazine_before_header', 'blossom_magazine_page_start', 20 );

if( ! function_exists( 'blossom_magazine_header' ) ) :
/**
 * Header Start
*/
function blossom_magazine_header(){ 
   
    $ed_random = get_theme_mod( 'ed_random_posts', false); ?>
    <header id="masthead" class="site-header style-one" itemscope itemtype="http://schema.org/WPHeader">
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <?php blossom_magazine_site_branding(); ?>
                </div>
                <div class="header-right">
                    <?php
                    blossom_magazine_social_links();
                    blossom_magazine_search(); ?>
                </div>
            </div>
        </div>
        <div class="header-main">
            <div class="container">
                <?php 
                if( $ed_random) echo '<div class="header-left-inner">';			
                    blossom_magazine_secondary_navigation();
                    blossom_magazine_random_posts_icon();
                if( $ed_random) echo '</div>';
                blossom_magazine_primary_navigation(); ?>
            </div>
        </div>
        <?php
        blossom_magazine_mobile_navigation();
        blossom_magazine_sticky_header();
        ?>
    </header>
    <?php
}
endif;
add_action( 'blossom_magazine_header', 'blossom_magazine_header', 20 );

if( ! function_exists( 'blossom_magazine_banner' ) ) :
/**
 * Banner Section 
*/
function blossom_magazine_banner(){

    if( is_front_page() ) blossom_magazine_get_banner(); 
      
}
endif;
add_action( 'blossom_magazine_after_header', 'blossom_magazine_banner', 15 );

if( ! function_exists( 'blossom_magazine_page_header' ) ) :
/**
 * Page Header
 *   
*/
function blossom_magazine_page_header(){ ?>    
    <?php        
        
        if( is_archive() ){              
        
            if( is_author() ){
                $author_title       = get_the_author_meta( 'display_name' );
                $author_description = get_the_author_meta( 'description' );
                $about_author       = get_theme_mod( 'author_title', __( 'About The Author', 'blossom-magazine' ) ); ?>
                <div class="page-header__content-wrapper">
                    <div class="author-section">
                        <h3 class="author-section-title">
                            <?php echo esc_html( $about_author ); ?>
                        </h3>
                        <div class="inner-author-section">
                            <div class="author-img-title-wrap">
                                <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 130 ); ?></figure>
                                <div class="author-title-wrap">
                                    <?php echo '<h1 class="author-name">' . esc_html( $author_title ) . '</h1>'; ?>
                                </div>
                            </div>
                            <?php if( $author_description ) : ?>
                                <div class="author-content-wrap">
                                    <?php echo '<div class="author-content">' . wp_kses_post( wpautop( $author_description ) ) . '</div>'; ?>      
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php blossom_magazine_posts_per_page_count(); ?>
                    </div>
                </div>
                <?php 
            } else {
                echo '<div class="page-header__content-wrapper">';
                the_archive_title();
                the_archive_description( '<div class="archive-description">', '</div>' );
                blossom_magazine_posts_per_page_count();
                echo '</div>';
            }
        }
        
        if( is_search() ){ 
            $search_title = get_theme_mod( 'search_title', __( 'Search Result For', 'blossom-magazine' ) );
            echo '<div class="page-header__content-wrapper">';
            echo '<h1 class="page-title">' . esc_html( $search_title ) . '</h1>';
            get_search_form();
            blossom_magazine_posts_per_page_count();
            echo '</div>';  
        }
    ?>
<?php }
endif;
add_action( 'blossom_magazine_before_posts_content', 'blossom_magazine_page_header', 10 );

if( ! function_exists( 'blossom_magazine_content_start' ) ) :
/**
 * Content Start
 * 
*/
function blossom_magazine_content_start(){       

    if( has_post_thumbnail() ){
        $thumbnail_class = '';
    }else{
        $thumbnail_class = 'no-thumbnail';
    }

    if( ! is_front_page() ) echo '<div id="content" class="site-content">';

    if( ! is_front_page() ) echo '<div class="page-header ' . $thumbnail_class . '">';
         
        if ( is_404() ) return;   
        
        if( ! is_front_page() && is_single() ){
            echo '<div class="container"><div class="breadcrumb-wrapper">';      
            //Breadcrumb
            blossom_magazine_breadcrumb();
            echo '</div></div>';
        }

        if ( is_home() && ! is_front_page() ){ 
            echo '<h1 class="page-title">';
            single_post_title();
            echo '</h1>';
        }
         
    if( ! is_front_page() ) echo '</div>'; 
    if( ! is_front_page() ) echo '<div class="container">'; ?>

    <?php
}
endif;
add_action( 'blossom_magazine_content', 'blossom_magazine_content_start', 10 );

if( ! function_exists( 'blossom_magazine_entry_header' ) ) :
/**
 * Entry Header
*/
function blossom_magazine_entry_header(){
    
    $ed_featured        = get_theme_mod( 'ed_featured_image', true );
    $ed_crop_single     = get_theme_mod( 'ed_crop_single', false );
    $sidebar            = blossom_magazine_sidebar();
    $image_size         = ( $sidebar ) ? 'blossom-magazine-with-sidebar' : 'blossom-magazine-single-full';
    $ed_post_date       = get_theme_mod( 'ed_post_date', false );
    $ed_post_author     = get_theme_mod( 'ed_post_author', false );
    $ed_cat_single      = get_theme_mod( 'ed_category', false );

    if ( is_single() ){
        ?>
        <header class="entry-header">
            <?php
                if( !$ed_cat_single ){ 
                    echo '<div class="entry-meta">';
                    blossom_magazine_category();
                    echo '</div>';
                }
                the_title( '<h1 class="entry-title">', '</h1>' );
            
                echo '<div class="entry-meta">';                                  
                if( !$ed_post_author ) blossom_magazine_posted_by();                            
                if( !$ed_post_date ) blossom_magazine_posted_on();
                echo '</div>';	
                ?>                    
        </header>
        <?php
        if ( $ed_featured && has_post_thumbnail() ) { 
            echo '<div class="post-thumbnail">';
                if( $ed_crop_single ){
                    the_post_thumbnail( 'full', array( 'itemprop' => 'image') );
                }else{
                    the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) ); 
                }
            echo '</div>';
        } ?>

        <div class="outer-content-wrap">
            <div class="inner-content-wrap">
                <?php blossom_magazine_article_meta(); ?>
            </div> 

            <?php         
    } else {
        echo '<div class="content-wrapper"><header class="entry-header">';  

        echo '<div class="entry-meta">';
        blossom_magazine_category();
        echo '</div>';           

        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

        echo '</header>';
        
    }    
}
endif;
add_action( 'blossom_magazine_post_entry_content', 'blossom_magazine_entry_header', 10 );

if ( ! function_exists( 'blossom_magazine_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function blossom_magazine_post_thumbnail() {

    $ed_crop_blog   = get_theme_mod( 'ed_crop_blog', false );
    $sidebar        = blossom_magazine_sidebar();
    
    if( is_home() ){
        $image_size = blossom_magazine_blog_layout_image_size(); 
        echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
        if( has_post_thumbnail() ){                        
            if( $ed_crop_blog ){
                the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );
            }else{
                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
            }
        }else{
            
            blossom_magazine_get_fallback_svg( $image_size );//fallback
        }        
        echo '</a>';
    }elseif( is_archive() || is_search() ){
        $image_size = blossom_magazine_blog_layout_image_size();
        echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
        if( has_post_thumbnail() ){
            if( $ed_crop_blog ){
                the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );
            }else{
                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
            }
        }else{
            blossom_magazine_get_fallback_svg( $image_size );//fallback
        }
        echo '</a>';
    }elseif( is_singular() ){
        $image_size = ( $sidebar ) ? 'blossom-magazine-with-sidebar' : 'full';
        
        if( has_post_thumbnail() ){
            echo '<div class="post-thumbnail">';
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
            echo '</div>';    
        }            
        
    }
}
endif;
add_action( 'blossom_magazine_before_page_entry_content', 'blossom_magazine_post_thumbnail' );
add_action( 'blossom_magazine_before_post_entry_content', 'blossom_magazine_post_thumbnail', 20 );

if( ! function_exists( 'blossom_magazine_entry_content' ) ) :
/**
 * Entry Content
*/
function blossom_magazine_entry_content(){ 

    $ed_excerpt          = get_theme_mod( 'ed_excerpt', true );
   ?>

    <div class="entry-content" itemprop="text">
		<?php
			if( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ){
                the_content();    
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blossom-magazine' ),
    				'after'  => '</div>',
    			) );
            }else{
                the_excerpt();
                echo '<div class="entry-meta">';
                blossom_magazine_posted_by();
                blossom_magazine_posted_on();
                echo '</div>';
            }

		?>
	</div><!-- .entry-content -->
    <?php if( ! is_singular() ) echo'</div>'; ?><!-- .content-wrapper -->
    <?php
    
}
endif;
add_action( 'blossom_magazine_page_entry_content', 'blossom_magazine_entry_content', 15 );
add_action( 'blossom_magazine_post_entry_content', 'blossom_magazine_entry_content', 15 );

if( ! function_exists( 'blossom_magazine_entry_footer' ) ) :
/**
 * Entry Footer
*/
function blossom_magazine_entry_footer(){ 
    ?>
	<footer class="entry-footer">
		<?php
			if( is_single() ){
			    blossom_magazine_tag();
			}
            
            if( get_edit_post_link() ){
                edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'blossom-magazine' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
            }
		?>
	</footer><!-- .entry-footer -->
    <?php if( is_single() ) echo '</div>'; ?><!-- .outer-content-wrap -->
	<?php 
}
endif;
add_action( 'blossom_magazine_page_entry_content', 'blossom_magazine_entry_footer', 20 );
add_action( 'blossom_magazine_post_entry_content', 'blossom_magazine_entry_footer', 20 );

if( ! function_exists( 'blossom_magazine_navigation' ) ) :
/**
 * Navigation
*/
function blossom_magazine_navigation(){
    if( is_singular() ){
        $next_post  = get_next_post();
        $prev_post  = get_previous_post();

        if( $prev_post || $next_post ){?>            
            <nav class="post-navigation navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'blossom-magazine' ); ?></h2>
                <div class="nav-links">
                    <?php if( $prev_post ){ ?>
                        <div class="nav-previous">
                            <figure class="post-thumbnail">
                                <?php $prev_img = get_post_thumbnail_id( $prev_post->ID ); ?>
                                <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
                                    <?php if( $prev_img ){
                                        $prev_url = wp_get_attachment_image_url( $prev_img, 'thumbnail' );
                                        echo '<img src="' . esc_url( $prev_url ) . '" alt="' . the_title_attribute( 'echo=0', $prev_post ) . '">';                                        
                                    }else{
                                        blossom_magazine_get_fallback_svg( 'thumbnail' );
                                    } ?>
                                </a>
                            </figure>
                            <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
                                <span class="meta-nav"><?php esc_html_e( 'Previous Article', 'blossom-magazine' ); ?></span>
                                <article class="post">
                                    <div class="content-wrap">
                                        <header class="entry-header">
                                            <h3 class="entry-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></h3>
                                        </header>
                                    </div>
                                </article>
                            </a>
                        </div>
                    <?php }
                    if( $next_post ){ ?>
                    <div class="nav-next">
                        <figure class="post-thumbnail">
                            <?php $next_img = get_post_thumbnail_id( $next_post->ID ); ?>
                            <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
                                <?php if( $next_img ){
                                    $next_url = wp_get_attachment_image_url( $next_img, 'thumbnail' );
                                    echo '<img src="' . esc_url( $next_url ) . '" alt="' . the_title_attribute( 'echo=0', $next_post ) . '">';                                        
                                }else{
                                    blossom_magazine_get_fallback_svg( 'thumbnail' );
                                } ?>
                            </a>
                        </figure>
                        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="prev">
                            <span class="meta-nav"><?php esc_html_e( 'Next Article', 'blossom-magazine' ); ?></span>
                            <article class="post">
                                <div class="content-wrap">
                                    <header class="entry-header">
                                        <h3 class="entry-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></h3>
                                    </header>
                                </div>
                            </article>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </nav>        
            <?php
        }
    }else{     
            
        the_posts_pagination( array(
            'prev_text'          => __( 'Previous', 'blossom-magazine' ),
            'next_text'          => __( 'Next', 'blossom-magazine' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'blossom-magazine' ) . ' </span>',
        ) );
               
    }
}
endif;
add_action( 'blossom_magazine_after_post_content', 'blossom_magazine_navigation', 20 );
add_action( 'blossom_magazine_after_posts_content', 'blossom_magazine_navigation' );

if( ! function_exists( 'blossom_magazine_author' ) ) :
/**
 * Author Section
*/
function blossom_magazine_author(){ 
    $ed_author    = get_theme_mod( 'ed_author', false );
    $author_title = get_theme_mod( 'author_title', __( 'About Author', 'blossom-magazine' ) );
    if( ! $ed_author && get_the_author_meta( 'description' ) ){ ?>
    <div class="author-section">
        <div class="inner-author-section">
            <div class="author-img-title-wrap">
                <figure class="author-img">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 95 ); ?>
                </figure>
                <div class="author-title-wrap">
                    <?php 
                        if( $author_title ) echo '<h5 class="title">' . esc_html( $author_title ) . '</h5>'; 
                        blossom_magazine_posted_by(); 
                    ?>
                </div>
            </div>
            <div class="author-content">
                <?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
            </div>
        </div>
	</div>
    <?php
    }
}
endif;
add_action( 'blossom_magazine_after_post_content', 'blossom_magazine_author', 15 );

if( ! function_exists( 'blossom_magazine_newsletter' ) ) :
/**
 * Newsletter
*/
function blossom_magazine_newsletter(){ 
    $ed_newsletter = get_theme_mod( 'ed_newsletter', false );
    $newsletter    = get_theme_mod( 'newsletter_shortcode' );
    if( !is_single() && !is_404() && $ed_newsletter && $newsletter ){ ?>
        <div class="newsletter-section section">
            <div class="container">
                <?php echo do_shortcode( $newsletter ); ?>
            </div>
        </div>
        <?php
    }
}
endif;
add_action( 'blossom_magazine_before_footer', 'blossom_magazine_newsletter', 30 );

if( ! function_exists( 'blossom_magazine_single_newsletter' ) ) :
/**
 * Newsletter
*/
function blossom_magazine_single_newsletter(){ 
    $ed_newsletter = get_theme_mod( 'ed_newsletter', false );
    $newsletter    = get_theme_mod( 'newsletter_shortcode' );
    if( $ed_newsletter && $newsletter ){ ?>
        <div class="newsletter-section section">
            <div class="container">
                <?php echo do_shortcode( $newsletter ); ?>
            </div>
        </div>
        <?php
    }
}
endif;
add_action( 'blossom_magazine_after_post_content', 'blossom_magazine_single_newsletter', 25 );

if( ! function_exists( 'blossom_magazine_related_posts' ) ) :
/**
 * Related Posts 
*/
function blossom_magazine_related_posts(){ 
    $ed_related_post = get_theme_mod( 'ed_related', true );
    
    if( $ed_related_post ){
        blossom_magazine_get_posts_list( 'related' );    
    }
}
endif;                                                                               
add_action( 'blossom_magazine_after_post_content', 'blossom_magazine_related_posts', 30 );

if( ! function_exists( 'blossom_magazine_latest_posts' ) ) :
/**
 * Latest Posts
*/
function blossom_magazine_latest_posts(){ 
    blossom_magazine_get_posts_list( 'latest' );
}
endif;
add_action( 'blossom_magazine_latest_posts', 'blossom_magazine_latest_posts' );

if( ! function_exists( 'blossom_magazine_comment' ) ) :
/**
 * Comments Template 
*/
function blossom_magazine_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if( get_theme_mod( 'ed_comments', true ) && ( comments_open() || get_comments_number() ) ) :
        echo '<div class="comment-list-wrapper">';
		    comments_template();
        echo '</div>';
	endif;
}
endif;
add_action( 'blossom_magazine_after_post_content', 'blossom_magazine_comment', blossom_magazine_comment_toggle() );
add_action( 'blossom_magazine_after_page_content', 'blossom_magazine_comment' );

if( ! function_exists( 'blossom_magazine_content_end' ) ) :
/**
 * Content End
*/
function blossom_magazine_content_end(){ 
                    
        if( ! is_front_page() ) echo '</div>'; //.container       
    if( ! is_front_page() ) echo '</div>'; ?><!-- .error-holder/site-content -->
    <?php
}
endif;
add_action( 'blossom_magazine_before_footer', 'blossom_magazine_content_end', 20 );

if( ! function_exists( 'blossom_magazine_instagram_section' ) ) :
/**
 * Bottom Instagram Section
*/
function blossom_magazine_instagram_section(){ 
    if( blossom_magazine_is_btif_activated() ){
        $ed_instagram = get_theme_mod( 'ed_instagram', false );
        if( $ed_instagram ){
            echo '<div class="instagram-section">';
            echo do_shortcode( '[blossomthemes_instagram_feed]' );
            echo '</div>';    
        }
    }
}
endif;
add_action( 'blossom_magazine_before_footer', 'blossom_magazine_instagram_section', 40 );

if( ! function_exists( 'blossom_magazine_footer_start' ) ) :
/**
 * Footer Start
*/
function blossom_magazine_footer_start(){
    ?>
    <footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'blossom_magazine_footer', 'blossom_magazine_footer_start', 20 );

if( ! function_exists( 'blossom_magazine_footer_top' ) ) :
/**
 * Footer Top
*/
function blossom_magazine_footer_top(){    
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
        <div class="footer-t">
    		<div class="container">
    			<div class="grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
    				<div class="col">
    				   <?php dynamic_sidebar( $active ); ?>	
    				</div>
                <?php } ?>
                </div>
    		</div>
    	</div>
        <?php 
    }   
}
endif;
add_action( 'blossom_magazine_footer', 'blossom_magazine_footer_top', 30 );

if( ! function_exists( 'blossom_magazine_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function blossom_magazine_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="container">
			<div class="site-info">            
            <?php
                blossom_magazine_get_footer_copyright();
                esc_html_e( ' Blossom Magazine | Developed By ', 'blossom-magazine' );
                echo '<span class="author-link"><a href="' . esc_url( 'https://blossomthemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Blossom Themes', 'blossom-magazine' ) . '</a></span>.';
                printf( esc_html__( '%1$s Powered by %2$s%3$s.', 'blossom-magazine' ), '<span class="wp-link">', '<a href="'. esc_url( __( 'https://wordpress.org/', 'blossom-magazine' ) ) .'" target="_blank">WordPress</a>', '</span>' );
                if( function_exists( 'the_privacy_policy_link' ) ){
                    the_privacy_policy_link();
                }
            ?>               
            </div>
            <div class="footer-bottom-right">
                <?php 
                    blossom_magazine_footer_navigation();
                ?>
            </div>
		</div>
	</div>
    <?php
}
endif;
add_action( 'blossom_magazine_footer', 'blossom_magazine_footer_bottom', 40 );

if( ! function_exists( 'blossom_magazine_footer_end' ) ) :
/**
 * Footer End 
*/
function blossom_magazine_footer_end(){ ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'blossom_magazine_footer', 'blossom_magazine_footer_end', 50 );

if( ! function_exists( 'blossom_magazine_back_to_top' ) ) :
/**
 * Back to top
*/
function blossom_magazine_back_to_top(){ ?>
    <button class="back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14.824" viewBox="0 0 18 14.824">
            <g id="Group_5480" data-name="Group 5480" transform="translate(1 1.408)" opacity="0.9">
                <g id="Group_5477" data-name="Group 5477" transform="translate(0 0)">
                <path id="Path_26477" data-name="Path 26477" d="M0,0H15.889" transform="translate(0 6.072)" fill="none"  stroke-linecap="round" stroke-width="2"/>
                <path id="Path_26478" data-name="Path 26478" d="M0,0,7.209,6,0,12.007" transform="translate(8.791 0)" fill="none"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                </g>
            </g>
        </svg>
    </button><!-- .back-to-top -->
    <?php
}
endif;
add_action( 'blossom_magazine_after_footer', 'blossom_magazine_back_to_top', 15 );

if( ! function_exists( 'blossom_magazine_page_end' ) ) :
/**
 * Page End
*/
function blossom_magazine_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'blossom_magazine_after_footer', 'blossom_magazine_page_end', 20 );