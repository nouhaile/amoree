( function( api ) {

	// Extends our custom "setto" section.
	api.sectionConstructor['setto'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );