jQuery(document).ready(function($){
	
	/**
	 * Removes class no-js from main container.
	 * If has class "no-js" container is set to display: none;
	 */
	
	 setTimeout(function(){ $( ".back-to-top-advanced" ).fadeIn("slow"); }, 1000);
	/**
	 * Options settings
	 */
	$( ".back-to-top-advanced-top" ).hide();
	$( ".back-to-top-advanced-left" ).hide();
	
	/**
	 * Back to top clicked
	 */
	$( ".button-advanced-up" ).click(function( event ) {
		event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, 500);
        return false;
	});
	
	/**
	 * Options clicked
	 */
	$( ".button-advanced.button-advanced-settings" ).click(function( event ) {
		event.preventDefault();
		$( ".back-to-top-advanced-left" ).toggle( 700, "easeInOutQuad" );
		$( ".back-to-top-advanced-top" ).toggle( 700, "easeInOutQuad" );
		$( ".btta-toggle" ).toggleClass("fa-angle-right");
	});
	
	/**
	 * Change background clicked
	 */
	$( ".button-advanced.button-advanced-background" ).click(function( event ) {
		event.preventDefault();
		$( "body" ).toggleClass("back-to-top-advanced-background");
	});
	
	/**
	 * Change text size clicked
	 */
	$( ".button-advanced.button-advanced-textsize" ).click(function( event ) {
		event.preventDefault();
		$( "body" ).toggleClass("back-to-top-advanced-textsize");
	});
});