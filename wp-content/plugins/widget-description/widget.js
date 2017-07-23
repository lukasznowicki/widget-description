jQuery( document ).ready( function( $ ) {
	for( var $key in widgetdesc ) {
		$( '#' + $key + ' .sidebar-description .description' ).html( widgetdesc[ $key ] );
	}
} );