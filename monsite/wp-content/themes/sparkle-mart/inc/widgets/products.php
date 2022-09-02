<?php
/**
 ** Adds sparkle_mart_products_widget widget.
**/
add_action('widgets_init', 'sparkle_mart_products_widget');
function sparkle_mart_products_widget() {
    register_widget('sparkle_mart_products_widget_area');
}
class sparkle_mart_products_widget_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    */
    public function __construct() {
        parent::__construct(
            'sparkle_mart_products_widget_area', esc_html__('&#9733; Products','sparkle-mart'), array(
            'description' => esc_html__('Display multiple category prodcuts', 'sparkle-mart')
        ));
    }
    
    private function widget_fields() {
        
          $prod_type = array(
            'rightalign'    => esc_html__('Right Align Category Image', 'sparkle-mart'),
            'leftalign'     => esc_html__('Left Align Category Image', 'sparkle-mart'),
            'no'            => esc_html__('No Category Image', 'sparkle-mart'),
          );

          $taxonomy     = 'product_cat';
          $empty        = 1;
          $orderby      = 'name';  
          $show_count   = 0;      // 1 for yes, 0 for no
          $pad_counts   = 0;      // 1 for yes, 0 for no
          $hierarchical = 1;      // 1 for yes, 0 for no  
          $title        = '';  
          $empty        = 0;
          $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
          );

          $woocommerce_categories = array();
          $woocommerce_categories_obj = get_categories($args);
          $woocommerce_categories[''] = esc_html__('Select Category','sparkle-mart');
          foreach ($woocommerce_categories_obj as $category) {
            $woocommerce_categories[$category->term_id] = $category->name;
          }

        $title_style = array(
            'layout_one'  => esc_html__('Layout One', 'sparkle-mart'),
            'layout_two'  => esc_html__('Layout Two', 'sparkle-mart'),
            'layout_three'  => esc_html__('Layout Three', 'sparkle-mart')
        );

        $fields = array( 
            
            'block_title_layout' => array(
                'sparklestore_widgets_name'          => 'block_title_layout',
                'sparklestore_widgets_title'         => esc_html__( 'Title Style', 'sparkle-mart' ),
                'sparklestore_widgets_default'       => 'layout_one',
                'sparklestore_widgets_field_type'    => 'select',
                'sparklestore_widgets_field_options' => $title_style
            ),

            'sparklestore_cat_product_title' => array(
                'sparklestore_widgets_name' => 'sparklestore_cat_product_title',
                'sparklestore_widgets_title' => esc_html__('Title', 'sparkle-mart'),
                'sparklestore_widgets_field_type' => 'title',
            ),
            'sparklestore_cat_product_short_desc' => array(
                'sparklestore_widgets_name' => 'sparklestore_cat_product_short_desc',
                'sparklestore_widgets_title' => esc_html__('Short Description', 'sparkle-mart'),
                'sparklestore_widgets_field_type' => 'textarea',
                'sparklestore_widgets_row'    => 4,
            ),
            'sparklestore_cat_image_aligment' => array(
                'sparklestore_widgets_name' => 'sparklestore_cat_image_aligment',
                'sparklestore_widgets_title' => esc_html__('Select Display Style (Image Alignment)', 'sparkle-mart'),
                'sparklestore_widgets_field_type' => 'select',
                'sparklestore_widgets_field_options' => $prod_type
            ),
            'sparklestore_woo_category' => array(
                'sparklestore_widgets_name' => 'sparklestore_woo_category',
                'sparklestore_widgets_title' => esc_html__('Category', 'sparkle-mart'),
                'sparklestore_widgets_field_type' => 'multiselect',
                'sparklestore_widgets_field_options' => $woocommerce_categories
              ),

            'sparklestore_cat_product_number' => array(
                'sparklestore_widgets_name' => 'sparklestore_cat_product_number',
                'sparklestore_widgets_title' => esc_html__('Number of products', 'sparkle-mart'),
                'sparklestore_widgets_default' => 4,
                'sparklestore_widgets_field_type' => 'number',
            ),

            'sparklestore_column' => array(
                'sparklestore_widgets_name' => 'sparklestore_column',
                'sparklestore_widgets_title' => esc_html__('Columns', 'sparkle-mart'),
                'sparklestore_widgets_field_type' => 'number',
                'sparklestore_widgets_default' => 4,
                'sparklestore_widgets_min_max' => array(
                    'min' => 1,
                    'max' => 6
                )
            ),

            'sparklestore_cat_cat_product_info' => array(
                'sparklestore_widgets_name' => 'sparklestore_cat_cat_product_info',
                'sparklestore_widgets_title' => esc_html__('Category Info', 'sparkle-mart'),
                'sparklestore_widgets_field_type' => 'checkbox',
            ), 
            
            'sparklestore_pagination' => array(
                'sparklestore_widgets_name' => 'sparklestore_pagination',
                'sparklestore_widgets_title' => esc_html__('Pagination', 'sparkle-mart'),
                'sparklestore_widgets_field_type' => 'checkbox',
            ), 

            'sparklestore_slider' => array(
                'sparklestore_widgets_name' => 'sparklestore_slider',
                'sparklestore_widgets_title' => esc_html__('Slider', 'sparkle-mart'),
                'sparklestore_widgets_field_type' => 'checkbox',
            ), 

        );

        return $fields;
    }

    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        /**
         * wp query for first block
        */ 
        $title_layout     = empty( $instance['block_title_layout'] ) ? 'layout_one' : $instance['block_title_layout']; 
        $title            = empty( $instance['sparklestore_cat_product_title'] ) ? '' : $instance['sparklestore_cat_product_title']; 
        $shot_desc        = empty( $instance['sparklestore_cat_product_short_desc'] ) ? '' : $instance['sparklestore_cat_product_short_desc'];
        $cat_aligment     = empty( $instance['sparklestore_cat_image_aligment'] ) ? 'rightalign' : $instance['sparklestore_cat_image_aligment'];
        $product_category = empty( $instance['sparklestore_woo_category'] ) ? array() : $instance['sparklestore_woo_category'];
        $product_number   = empty( $instance['sparklestore_cat_product_number'] ) ? 4 : $instance['sparklestore_cat_product_number'];
        $cat_info         = empty( $instance['sparklestore_cat_cat_product_info'] ) ? '' : $instance['sparklestore_cat_cat_product_info'];

        $pagination     = empty( $instance['sparklestore_pagination'] ) ? '' : $instance['sparklestore_pagination'];
        $column         = empty( $instance['sparklestore_column'] ) ? 4 : $instance['sparklestore_column'];
        $data_layout    = empty( $instance['sparklestore_slider'] ) ? 'grid' : 'slider';

        if( !empty( $product_category ) ){
          $cat_id = get_term($product_category[0], 'product_cat');

          $category_id = $cat_id ? $cat_id->term_id : '';
          $category_link = get_term_link( $category_id,'product_cat' );
          if(is_wp_error($category_link)){
            $category_link = get_permalink( wc_get_page_id( 'shop' ) );
          }
        }
        else{
            $category_id = false;
            $category_link = get_permalink( wc_get_page_id( 'shop' ) );
        } 
        
        echo $before_widget; 
    ?>  

    <div class="categorproducts <?php echo esc_attr( $title_layout ); ?>">
        <div class="container">                
            <div class="categoryarea-wrap">                
                <div id="categoryproductslider" class="categoryproductslider <?php echo esc_attr( $cat_aligment ); ?>">
                    <?php if(!empty( $title )) { ?>    
                        <div class="blocktitlewrap">
                            <div class="blocktitle">
                                <?php if(!empty( $title )) { ?><h2><?php echo esc_html( $title ); ?></h2><?php } ?>
                                <?php if(!empty( $shot_desc )) { ?><p><?php echo esc_html( $shot_desc ); ?></p><?php } ?>
                                <?php if( $data_layout == 'slider'): ?>
                                <div class="SparkleStoreAction">
                                    <div class="sparkle-lSPrev"></div>
                                    <div class="sparkle-lSNext"></div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="categoryproductwrap">
                        <?php if( $cat_aligment !=='no'): ?>
                        <div class="homeblockinner"> 
                            <?php 
                                $taxonomy = 'product_cat';                                
                                $terms = term_description( $category_id, $taxonomy );
                                $terms_name = get_term( $category_id, $taxonomy );
                                $thumbnail_id = get_term_meta( $category_id, 'thumbnail_id', true);
                                if ( !is_wp_error($thumbnail_id) && !empty( $thumbnail_id ) ) {
                                  $image = wp_get_attachment_image_src($thumbnail_id, 'shop_single');
                                } else{ 
                                    $no_image = 'https://via.placeholder.com/285x370';
                                }  
                            ?>
                            <div class="catblockwrap" <?php  if ( !is_wp_error($thumbnail_id) && !empty($thumbnail_id)) {  ?>style="background-image:url(<?php echo esc_url($image[0]); ?>);"<?php } else{ ?>style="background-image:url(<?php echo esc_url($no_image); ?>);"<?php } ?>>
                                <?php if( $cat_info  ): ?>
                                <div class="block-title-desc">                                
                                    <div class="table-outer">
                                        <div class="table-inner">
                                            <?php if( !is_wp_error($terms_name) && !empty( $terms_name->name ) ) { ?><h2><a href="<?php echo esc_url( $category_link ); ?>"><?php echo esc_html( $terms_name->name ); ?></a></h2><?php } ?>
                                            <?php echo esc_attr( $terms ); ?>
                                            <a href="<?php echo esc_url($category_link); ?>" class="btn btn-primary"><?php esc_html_e('Shop Now','sparkle-mart'); ?></a>
                                        </div>
                                    </div>                        
                                </div>
                                <?php else: ?>
                                    <a href="<?php echo esc_url($category_link); ?>" class="sparkle-overlay"></a>      
                                <?php endif; ?>
                            </div>                        
                        </div>
                        <?php endif; ?>

                        <div class="productwrap">
                            <ul class="catwithproduct <?php if ($data_layout == 'slider') echo 'cS-hidden'; ?> gallery gallery-columns-<?php echo intval($column); ?>" data-layout="<?php echo esc_attr($data_layout); ?>"  data-column="<?php echo esc_attr($column); ?>">                        
                                <?php 
                                    global $paged;
                                    if(get_query_var('paged')) {
                                        $paged = get_query_var('paged');
                                    } else if(get_query_var('page')) {
                                        $paged = get_query_var('page');
                                    } else {
                                        $paged = 1;
                                    }

                                    $product_args = array(
                                        'post_type' => 'product',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy'  => 'product_cat',
                                                'field'     => 'id', 
                                                'terms'     => $product_category                                                                 
                                            )),
                                        'posts_per_page' => $product_number
                                    );
                                    $product_args['paged'] 		= $paged;
                                    $query = new WP_Query($product_args);

                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                ?>
                                    <?php wc_get_template_part( 'content', 'product' ); ?>
                                    
                                <?php } } wp_reset_postdata(); ?>                          
                            </ul>
                            <?php
                            // Display pagination if enabled
                            if( $pagination ) {
                                echo '<div class="clearfix widget-pagination">';
                                sparkle_mart_pagination($query);
                                echo '</div>';
                            }
                            ?>
                        </div> 
                        
                    </div>
                </div>
            </div>        
        </div>        
    </div>

    <?php         
        echo $after_widget;
    }
   
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            $instance[$sparklestore_widgets_name] = sparklestore_widgets_updated_field_value($widget_field, $new_instance[$sparklestore_widgets_name]);
        }
        return $instance;
    }

    public function form($instance) {
        $widget_fields = $this->widget_fields();
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            $sparklestore_widgets_field_value = !empty($instance[$sparklestore_widgets_name]) ? $instance[$sparklestore_widgets_name] : '';
            sparklestore_widgets_show_widget_field($this, $widget_field, $sparklestore_widgets_field_value);
        }
    }
}