jQuery( document ).ready( function () {
    jQuery( "#jm_breaking_news_internal" ).change( function() {
        if ( jQuery( this ).val() == "1" ) {
            jQuery( "#internal-link" ).show();
            jQuery( "#external-link" ).hide();
        }
    } );
    jQuery( "#jm_breaking_news_external" ).change( function() {
        if ( jQuery( this ).val() == "0" ) {
            jQuery( "#internal-link" ).hide();
            jQuery( "#external-link" ).show();
        }
    } );
    jQuery( '#jm_breaking_news_color' ).wpColorPicker();
    jQuery( '#jm_breaking_news_background_color' ).wpColorPicker();
    jQuery( '#jm_breaking_news_text_color' ).wpColorPicker();
    jQuery( '#jm_breaking_news_news_text_color' ).wpColorPicker();
} );