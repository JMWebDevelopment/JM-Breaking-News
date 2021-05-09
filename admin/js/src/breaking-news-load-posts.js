jQuery( function( $ ) {
	$.get( jmloadposts.rest_url + 'wp/v2/posts?per_page=25', function( res ) {
		console.log( res );
		if ( res ) {
			let html = '';
			res.forEach( function( post ) {
				let selected = '';
				if ( jmloadposts.selected_post !== '' && jmloadposts.selected_post === post.id ) {
					selected = 'selected="selected"';
				}
				html += '<option value="' + post.id + '" ' + selected + '>' + post.title.rendered + '</option>';
			} );
			$( '#jm_breaking_news_internal_link' ).html( html );
		}
	} );
} );
