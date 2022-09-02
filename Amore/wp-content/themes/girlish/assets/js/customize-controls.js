/**
 * Scripts within the customizer controls window.
 *
 */

jQuery( document ).ready(function($) {
    //Chosen JS
    $(".girlish-chosen-select").chosen({
        width: "100%"
    });

    // icon picker
    $('.girlish-icon-picker').each( function() {
        $(this).iconpicker( '#' + this.id );
    } );

    //Switch Control
    $('body').on('click', '.onoffswitch', function(){
        var $this = $(this);
        if($this.hasClass('switch-on')){
            $(this).removeClass('switch-on');
            $this.next('input').val( false ).trigger('change')
        }else{
            $(this).addClass('switch-on');
            $this.next('input').val( true ).trigger('change')
        }
    });


    $( document ).on( 'click', '.customize_multi_add_field', girlish_customize_multi_add_field )
        .on( 'change', '.customize_multi_single_field', girlish_customize_multi_single_field )
        .on( 'click', '.customize_multi_remove_field', girlish_customize_multi_remove_field )



    	/********* Multi Input Custom control ***********/
	$( '.customize_multi_input' ).each(function() {
		var $this = $( this );
		var multi_saved_value = $this.find( '.customize_multi_value_field' ).val();
		if (multi_saved_value.length > 0) {
			var multi_saved_values = multi_saved_value.split( "|" );
			$this.find( '.customize_multi_fields' ).empty();
			$.each(multi_saved_values, function( index, value ) {
				$this.find( '.customize_multi_fields' ).append( '<div class="set"><input type="text" value="' + value + '" class="customize_multi_single_field" /><span class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span></div>' );
			});
		}
	});

	function girlish_customize_multi_add_field(e) {
		var $this = $( e.currentTarget );
		e.preventDefault();
		if ( ! $this.data( 'lockedAt' ) || + new Date() - $this.data( 'lockedAt' ) > 300 ) {
			var $control = $this.parents( '.customize_multi_input' );
			$control.find( '.customize_multi_fields' ).append( '<div class="set"><input type="text" value="" class="customize_multi_single_field" /><span class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span></div>' );
			girlish_customize_multi_write( $control );
		}
		$this.data( 'lockedAt', + new Date() );
	}

	function girlish_customize_multi_single_field() {
		var $control = $( this ).parents( '.customize_multi_input' );
		girlish_customize_multi_write( $control );
	}

	function girlish_customize_multi_remove_field(e) {
		e.preventDefault();
		var $this = $( this );
		var $control = $this.parents( '.customize_multi_input' );
		$this.parent().remove();
		girlish_customize_multi_write( $control );
	}

	function girlish_customize_multi_write( $element) {
		var customize_multi_val = '';
		$element.find( '.customize_multi_fields .customize_multi_single_field' ).each(function() {
			customize_multi_val += $( this ).val() + '|';
		});
		$element.find( '.customize_multi_value_field' ).val( customize_multi_val.slice( 0, -1 ) ).change();
    }
});
    
jQuery(document).ready(function($) {
    // Sortable sections
    jQuery( 'ul.girlish-sortable-list' ).sortable({
        handle: '.girlish-drag-handle',
        axis: 'y',
        update: function( e, ui ){
            jQuery('input.girlish-sortable-input').trigger( 'change' );
        }
    });

    /* On changing the value. */
    jQuery( "body" ).on( 'change', 'input.girlish-sortable-input', function() {
        /* Get the value, and convert to string. */
        this_checkboxes_values = jQuery( this ).parents( 'ul.girlish-sortable-list' ).find( 'input.girlish-sortable-input' ).map( function() {
            return this.value;
        }).get().join( ',' );

        /* Add the value to hidden input. */
        jQuery( this ).parents( 'ul.girlish-sortable-list' ).find( 'input.girlish-sortable-value' ).val( this_checkboxes_values ).trigger( 'change' );

    });
});

/**
 * Add a listener to update other controls to new values/defaults.
 */

( function( api ) {

    const  girlish_section_lists = [
    'hero_banner_section',
    'featured_shop_section',
    'cta_section',
    'collection_section',
    'testimonial_section',
    'latest_posts_section',
    'subscribe_now_section',
    'featured_slider_section',
    'advertisement_section',
    'featured_posts_section',
    'popular_posts_section',
    'promotion_section',
    'service_section',
    'counter_section',
    'our_partners_section',
    'our_team_section',
    'more_featured_section',
    'events_section',
    'contact_section',
    ];
     girlish_section_lists.forEach( girlish_homepage_scroll );

    function girlish_homepage_scroll(item, index) {
         // Detect when the front page sections section is expanded (or closed) so we can adjust the preview accordingly.
        wp.customize.section( 'girlish_'+item, function( section ) {
            section.expanded.bind( function( isExpanding ) {
                //console.log( isExpanding );
                // Value of isExpanding will = true if you're entering the section, false if you're leaving it.
                wp.customize.previewer.send( item, { expanded: isExpanding });
            } );
        } );
    }

    // Only show the color hue control when there's a custom color scheme.
    wp.customize( 'girlish_theme_options[colorscheme]', function( setting ) {
        wp.customize.control( 'girlish_theme_options[colorscheme_hue]', function( control ) {
            var visibility = function() {
                if ( 'custom' === setting.get() ) {
                    control.container.slideDown( 180 );
                } else {
                    control.container.slideUp( 180 );
                }
            };

            visibility();
            setting.bind( visibility );
        });
    });

    wp.customize( 'girlish_theme_options[reset_options]', function( setting ) {
        setting.bind( function( value ) {
            var code = 'needs_refresh';
            if ( value ) {
                setting.notifications.add( code, new wp.customize.Notification(
                    code,
                    {
                        type: 'info',
                        message: girlish_reset_data.reset_message
                    }
                ) );
            } else {
                setting.notifications.remove( code );
            }
        } );
    } );

    // Deep linking for menus
    wp.customize.bind('ready', function() {
        jQuery('a.topbar-menu-trigger').click(function(e) {
            e.preventDefault();
            wp.customize.section( 'menu_locations' ).focus()
        });
    });
} )( wp.customize );