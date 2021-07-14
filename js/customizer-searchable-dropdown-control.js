(
	function ( $ ) {
		wp.customize.bind( 'ready', function () {

			const customize = this;

			const dropdownControls = $( '.customize-searchable-dropdown-label' ).parent();

			const dropdownControlIds = [];

			//Segment in the id of the control that is added by wordpress, but not needed for our purpose
			const idSegment = "customize-control-";

			//fill the id array
			for ( var control of dropdownControls ) {
				//remove the segment from the control id
				var controlId = control.id.substring( idSegment.length, control.id.length );
				dropdownControlIds.push( controlId );
			}

			// bind onclicks
			$( '.customizer-searchable-dropdown-input' ).each( function () {
				const id = $( this ).attr( 'id' );
				const inputField = $( this );
				const dropdown = inputField.parent().find( '.customizer-searchable-dropdown-content' ).first();

				inputField.on('click', function () {
					dropdown.toggle();
				} );

				inputField.parent().find( '.customizer-dropdown-item' ).each( function () {
					const item = $( this );
					$( this ).on( 'click', function () {
						inputField.val( item.text() ).trigger( 'change' );
					} );
				} );
			} );

			// bind search filters
			$( '.customizer-searchable-dropdown-search' ).each( function () {
				$( this ).on( 'keyup', function () {
					const search = $( this ).val().toLowerCase();
					const id = $( this ).attr( 'id' );
					const prefix = 'dropdown-search-';
					const instanceNumber = parseInt( id.substring( prefix.length ) );

					// toggle search items
					$( '#dropdown-options-dropdown-' + instanceNumber )
						.find( '.customizer-dropdown-item' )
						.each( function () {
							if ( $( this ).text().toLowerCase().indexOf( search ) > - 1 ) {
								$( this ).show();
							} else {
								$( this ).hide();
							}
						} );
				} );
			} );


		} );
	}
)( jQuery );