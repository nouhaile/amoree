( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['blossom-magazine-pro-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

jQuery(document).ready(function($) {

    wp.customize.panel( 'frontpage_settings', function( section ){
        section.expanded.bind( function( isExpanded ) {
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( blossom_magazine_cdata.home );
            }
        });
    });
    
    //Scroll to Front Page Sections
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });

    function scrollToSection( section_id ){

        var preview_section_id = "banner_section";

        var $contents = jQuery('#customize-preview iframe').contents();

        switch ( section_id ) {

            case 'accordion-section-cta_section':
            preview_section_id = "cta_section";
            break;

            case 'accordion-section-popular_cat_section':
            preview_section_id = "popular_cat_section";
            break;

        }

        if( $contents.find( '#' + preview_section_id ).length > 0 && $contents.find('.home').length > 0 ){
            $contents.find("html, body").animate({
            scrollTop: $contents.find( '#' + preview_section_id ).offset().top
            }, 1000);
        }

    }

    $( 'input[name=blossom-magazine-flush-local-fonts-button]' ).on( 'click', function( e ) {
        var data = {
            wp_customize: 'on',
            action: 'blossom_magazine_flush_fonts_folder',
            nonce: blossom_magazine_cdata.flushFonts
        };  
        $( 'input[name=blossom-magazine-flush-local-fonts-button]' ).attr('disabled', 'disabled');

        $.post( ajaxurl, data, function ( response ) {
            if ( response && response.success ) {
                $( 'input[name=blossom-magazine-flush-local-fonts-button]' ).val( 'Successfully Flushed' );
            } else {
                $( 'input[name=blossom-magazine-flush-local-fonts-button]' ).val( 'Failed, Reload Page and Try Again' );
            }
        });
    }); 
    
});