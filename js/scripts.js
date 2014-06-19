( function ( $ ) {
	// main part of script
	$( document ).ready( function () { 
		$('.flexslider').flexslider({ /*initial slider*/
			animation: "slide",
			directionNav: false
		});		
		/*refresh all forms*/
		$( 'input:checked' ).removeAttr( 'checked' );
		$( 'input:file' ).val( '' );
		/*work with form elements*/
		/*radiobuttons restyle*/
		$( 'input[type=radio]' ).wrap( '<div class="grngrdn-radio"></div>' );
		/*hover realization*/
		$( '.grngrdn-radio' ).mouseenter( function () {
			$( this ).addClass( 'grngrdn-hover' );
		});
		$( '.grngrdn-radio' ).mouseleave( function () {
			$( this ).removeClass( 'grngrdn-hover' );
		});
		/*active realization*/
		$( '.grngrdn-radio' ).click( function () {
			var current_name = $( this ).find( 'input' ).attr( 'name' );
			if ( $( this ).find( 'input' ).is( ':checked' ) ) {
			}
			else {
				$( this ).closest( 'form' ).find( 'input[type=radio]' ).each( function () {
					if ( $( this ).attr( 'name' )  == current_name ) {
						$( this ).removeAttr( 'checked' );
						$( this ).parent().removeClass( 'grngrdn-active' );
					}
				});
				$( this ).addClass( 'grngrdn-active' );
				$( this ).find( 'input' ).attr( 'checked', true );
			}
		});
		/*checkboxes restyle*/
		$( 'input[type=checkbox]' ).wrap( '<div class="grngrdn-check"></div>' );
		/*hover realization*/
		$( '.grngrdn-check' ).mouseenter( function () {
			$( this ).addClass( 'grngrdn-hover' );
		});
		$( '.grngrdn-check' ).mouseleave( function () {
			$( this ).removeClass( 'grngrdn-hover' );
		});		
		/*active Realization*/
		$( '.grngrdn-check' ).click( function () {
			if ( $( this ).find( 'input' ).is( ':checked' ) ) {
				$( this ).removeClass( 'grngrdn-active' );
				$( this ).find( 'input' ).attr( 'checked', false );
			}
			else {
				$( this ).addClass( 'grngrdn-active' );
				$( this ).find( 'input' ).attr( 'checked', true );
			}
		});
		/*reset button restyle*/
		$( 'input:reset' ).click( function () {
			/*reset checkboxes and radio*/
			$( this ).closest( 'form' ).find( 'input' ).each( function () {
				$( this ).removeAttr( 'checked' );
			});
			$( this ).closest( 'form' ).find( '.grngrdn-option' ).removeClass( 'grngrdn-option-selected' );
			$( this ).closest( 'form' ).find( '.grngrdn-radio' ).removeClass( 'grngrdn-active' );
			$( this ).closest( 'form' ).find( '.grngrdn-check' ).removeClass( 'grngrdn-active' );
			/*reset input:file*/
			$( this ).closest( 'form' ).find( '.grngrdn-custom-file-text' ).text( script_loc.choose_file );
			$( this ).closest( 'form' ).find( '.grngrdn-custom-file-status' ).text( script_loc.file_is_not_selected );
			/*reset select*/
			$( this ).closest( 'form' ).find( '.grngrdn-active-opt' ).find( 'div:first' ).text( $( this ).closest( 'form' ).find( 'select' ).find( 'option:first' ).text() );
			$( this ).closest( 'form' ).find( 'select' ).find( 'option' ).each( function () {
					$( this ).removeAttr( 'selected' );
			});
		});
		/*select section restyle*/
		var test = $( 'select' ).size();
		for ( var k = 0; k < test; k++ ) {
			$( 'select' ).eq( k ).css( 'display', 'none' );
			$( 'select' ).eq( k ).after( CreateSelect( k ) );
		}
		/*functional of new select*/
		$( '.grngrdn-select' ).click( function () {
			if ( $( this ).find( '.grngrdn-options' ).css( 'display' ) == 'none' ) {
				$( this ).css( 'z-index', '100' );
				$( this ).find( '.grngrdn-options' ).css( {
					'display': 'block'
				});
			} else {
				$( this ).css( 'z-index', '10' );
				$( this ).find( '.grngrdn-options' ).css( {
					'display': 'none'
				});
			}
		});
		$( '.grngrdn-select' ).find( '.grngrdn-option' ).click( function () {
			$( this ).closest( '.grngrdn-select' ).find( '.grngrdn-option' ).removeClass( 'grngrdn-option-selected' );
			$( this ).addClass( 'grngrdn-option-selected' );
			/*write text to active opt*/
			$( this ).parent().parent().find( '.grngrdn-active-opt' ).find( 'div:first' ).text( $( this ).text() );
			/*remove active option from init select*/
			$( this ).parent().parent().prev( 'select' ).find( 'option' ).removeAttr( 'selected' );
			/*add atrr selected to select*/
			$( this ).parent().parent().prev( 'select' ).find( 'option' ).eq( ( $( this ).attr( 'name' ) ) ).attr( 'selected', 'selected' );
		});
		/*input:file restyle*/
		$( createInputAttr() );
		/*functional of new input:file*/
		$( '.grngrdn-custom-file' ).click( function () {
			var file_input = document.getElementById( $( this ).find( '.grngrdn-custom-file-status' ).attr('name') )
			$( file_input ).click();
		});
		$( 'input:file' ).change( function () {
			var val=$(this).attr('id');
			$( '[name='+val+']' ).text( $( this ).val().split( '\\' ).pop() )
		});
		/*archive-dropdown widget functional*/
		$( '[name=archive-dropdown]' ).next( '.grngrdn-select' ).find( '.grngrdn-option' ).click( function () {
			if ( $( this ).attr( 'value' ) ){
				location.href = $( this ).attr( 'value' );
			}
		});
		/*category-dropdown widget functional*/
		$( '#cat' ).next( '.grngrdn-select' ).find( '.grngrdn-option' ).click( function () {
			if ( $( this ).attr( 'value' ) > 0 ) {
				location.href = script_loc.grng_home_url + '?cat=' + $( this ).attr( 'value' );
			}
		});
	});
} )( jQuery );
/* define all custom functions */
/*function for input:file*/
function CreateFileInput( k ) {
	var custom_file = document.createElement( 'div' );
	( function ( $ ) {
		$( custom_file ).addClass( 'grngrdn-custom-file' );
		$( custom_file ).append( '<div class="grngrdn-custom-file-content"></div>' );
		$( custom_file ).find( '.grngrdn-custom-file-content' ).append( '<div class="grngrdn-custom-file-text"></div>' );
		$( custom_file ).find( '.grngrdn-custom-file-content' ).append( '<div class="grngrdn-custom-file-button"></div>' );
		$( custom_file ).append( '<div class="grngrdn-custom-file-status"></div>' );
		$( custom_file ).find('.grngrdn-custom-file-status').attr( 'name', $( 'input:file' ).eq(k).attr( 'id' ))
		$( custom_file ).find( '.grngrdn-custom-file-text' ).text( script_loc.choose_file );
		$( custom_file ).find( '.grngrdn-custom-file-status' ).text( script_loc.file_is_not_selected );
		$( custom_file ).append( '<div class="clear"></div>' );
	} )( jQuery );
	return custom_file;
}
/*function for hide init input:file and add after a new input:file*/
function createInputAttr() {
	( function ( $ ) {
		var size = $( 'input:file' ).size();
		for (var i = 0; i < size; i++) {
			$( 'input:file' ).eq(i).attr( 'id', 'file-' + i ).css( 'display', 'none' ).after( CreateFileInput( i ) );
		};
	} )( jQuery );
}
/*function for custom select*/
function CreateSelect( k ) {
	/*create select division*/
	var sel = document.createElement( 'div' );
	( function ( $ ) {
		$( sel ).addClass( 'grngrdn-select' );
		/*create active-option division*/
		var active_opt = document.createElement( 'div' );
		$( active_opt ).addClass( 'grngrdn-active-opt' );
		$( active_opt ).append( '<div></div>' );
		$( active_opt ).append( '<div class="grngrdn-select-button"></div>' );
		$( active_opt ).find( 'div:first' ).text( $( 'select' ).eq( k ).find( 'option' ).first().text() );
		/*create options division*/
		var option_array = document.createElement( 'div' );
		$( option_array ).addClass( 'grngrdn-options' );
		/*create array of optgroups*/
		var count = $( 'select' ).eq( k ).find( 'optgroup' ).size();
		var optgroups = [];
		/*create options division*/
		if ( count ) {
			var z = 0;
			for ( var i = 0; i < count; i++ ) {
				optgroups[i] = document.createElement( 'div' );
				$( optgroups[i] ).addClass( 'grngrdn-optgroup' );
				$( optgroups[i] )
					.text( $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).attr( 'label' ) );
			};
			for ( var i = 0; i < count; i++ ) {
				$( option_array ).append( optgroups[i] );
				for ( var j = 0; j < $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().size(); j++ ) {
					var opt = document.createElement( 'div' );
					$( opt ).addClass( 'grngrdn-option' );
					$( opt ).attr( 'value', $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().eq( j ).attr( 'value' ) );
					$( opt ).text( $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().eq( j ).text() );
					$( opt ).attr( 'name', z );
					z++;
					$( option_array ).append( opt );
				};
			};
		} else {
			for ( var i = 0; i < $( 'select' ).eq( k ).find( 'option' ).size(); i++ ) {
				var opt = document.createElement( 'div' );
				$( opt ).addClass( 'grngrdn-option' );
				$( opt ).attr( 'value', $( 'select' ).eq( k ).find( 'option' ).eq( i ).attr( 'value' ) );
				$( opt ).attr( 'name', i );
				$( opt ).text( $( 'select' ).eq( k ).find( 'option' ).eq( i ).text() );
				$( option_array ).append( opt );
			};
		};
		$( sel ).append( active_opt );
		$( sel ).append( option_array );
	} )( jQuery );
	return sel;
}